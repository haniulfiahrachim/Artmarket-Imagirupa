@props(['pesanan', 'lawanBicara'])

<div class="card" style="height:600px;display:flex;flex-direction:column;">
    {{-- Header --}}
    <div class="card-header py-3">
        <div class="d-flex align-items-center gap-2">
            <div class="rounded-circle text-white d-flex align-items-center justify-content-center fw-bold"
                style="width:34px;height:34px;font-size:13px;background:#6C3483;flex-shrink:0;">
                {{ strtoupper(substr($lawanBicara->nama, 0, 1)) }}
            </div>
            <div>
                <div class="fw-semibold" style="font-size:0.88rem;">{{ $lawanBicara->nama }}</div>
                <div class="text-muted" style="font-size:0.72rem;">{{ ucfirst($lawanBicara->role) }}</div>
            </div>
            <div class="ms-auto">
                <span class="badge bg-warning text-dark" style="font-size:0.65rem;">
                    <i class="bi bi-shield-check me-1"></i>Chat Aman
                </span>
            </div>
        </div>
    </div>

    {{-- Notice --}}
    <div class="px-3 pt-2 pb-1" style="background:#fff8e1;border-bottom:1px solid #ffe082;">
        <div style="font-size:0.72rem;color:#856404;">
            <i class="bi bi-exclamation-triangle-fill me-1"></i>
            <strong>Perhatian:</strong> Dilarang berbagi nomor telepon, kontak WA/Telegram, atau melakukan transaksi di luar sistem Imagirupa. Pelanggaran dapat menyebabkan akun diblokir.
        </div>
    </div>

    {{-- Chat Error / Success --}}
    @if(session('chat_error'))
    <div class="mx-3 mt-2">
        <div class="alert alert-danger py-2 mb-0" style="font-size:0.8rem;">
            <i class="bi bi-x-circle me-1"></i>{{ session('chat_error') }}
        </div>
    </div>
    @endif

    {{-- Messages --}}
    <div class="flex-grow-1 overflow-auto p-3" id="chatBox"
        style="display:flex;flex-direction:column;gap:.6rem;">
        @forelse($pesanan->chats as $chat)
        <div class="d-flex {{ $chat->pengirim_id === auth()->id() ? 'justify-content-end' : 'justify-content-start' }}">
            <div class="px-3 py-2 rounded-3"
                style="max-width:80%;word-break:break-word;{{ $chat->pengirim_id === auth()->id()
                    ? 'background:#6C3483;color:#fff;'
                    : 'background:#f0f0f0;color:#333;' }}">
                <div style="font-size:0.75rem;opacity:0.75;margin-bottom:2px;">{{ $chat->pengirim->nama }}</div>
                <div style="font-size:0.88rem;">{{ $chat->pesan }}</div>
                <div class="text-end" style="font-size:0.66rem;opacity:0.6;margin-top:3px;">
                    {{ $chat->waktu_kirim->format('H:i') }}
                </div>
            </div>
        </div>
        @empty
        <div class="text-center text-muted py-5" style="font-size:0.85rem;">
            <i class="bi bi-chat-dots fs-2 d-block mb-2 opacity-25"></i>
            Belum ada pesan. Mulai percakapan!
        </div>
        @endforelse
        <div id="chatEnd"></div>
    </div>

    {{-- Input --}}
    <div class="card-footer p-2" style="background:#fafafa;">
        <form method="POST" action="{{ route('chat.send', $pesanan) }}"
              class="d-flex gap-2" id="chatForm">
            @csrf
            <input type="text" name="pesan" id="chatInput"
                class="form-control form-control-sm"
                placeholder="Tulis pesan... (no kontak/nomor HP)"
                maxlength="500"
                autocomplete="off"
                required>
            <button class="btn btn-primary btn-sm px-3" id="chatSendBtn">
                <i class="bi bi-send"></i>
            </button>
        </form>
        <div class="d-flex justify-content-between mt-1 px-1">
            <div id="chatWarning" class="text-danger" style="font-size:0.68rem;display:none;">
                <i class="bi bi-exclamation-circle me-1"></i><span id="chatWarningText"></span>
            </div>
            <div class="text-muted ms-auto" style="font-size:0.68rem;">
                <span id="charCount">0</span>/500
            </div>
        </div>
    </div>
</div>

@once
@push('scripts')
<script>
(function() {
    const input      = document.getElementById('chatInput');
    const sendBtn    = document.getElementById('chatSendBtn');
    const warning    = document.getElementById('chatWarning');
    const warningTxt = document.getElementById('chatWarningText');
    const charCount  = document.getElementById('charCount');
    const chatEnd    = document.getElementById('chatEnd');

    if (chatEnd) chatEnd.scrollIntoView({ behavior: 'smooth' });

    // Pola terlarang di sisi client
    const forbiddenPatterns = [
        { pattern: /08\d{8,11}/,                       msg: 'Nomor HP tidak diperbolehkan.' },
        { pattern: /(\+62|62)\d{8,12}/,               msg: 'Nomor HP tidak diperbolehkan.' },
        { pattern: /\d{6,}/,                           msg: 'Rangkaian angka panjang tidak diperbolehkan.' },
        { pattern: /whatsapp|whatsap|wa\.me/i,         msg: 'Link/mention WhatsApp tidak diperbolehkan.' },
        { pattern: /telegram|t\.me/i,                  msg: 'Link Telegram tidak diperbolehkan.' },
        { pattern: /transfer\s*(ke|bca|bni|bri|dana|ovo|gopay)/i, msg: 'Informasi transfer di luar sistem tidak diperbolehkan.' },
        { pattern: /bayar\s*(langsung|diluar|ke\s*(aku|saya))/i,  msg: 'Ajakan transaksi di luar platform tidak diperbolehkan.' },
    ];

    function checkInput(val) {
        // Hapus semua spasi untuk cek angka
        const noSpace = val.replace(/\s+/g, '');
        for (const item of forbiddenPatterns) {
            // Test dengan spasi dihapus untuk angka
            const testVal = item.pattern.source.includes('\\d') ? noSpace : val;
            if (item.pattern.test(testVal)) {
                return item.msg;
            }
        }
        return null;
    }

    function blockAngka(e) {
        const val = input.value;
        charCount.textContent = val.length;

        const errMsg = checkInput(val);
        if (errMsg) {
            warning.style.display = 'block';
            warningTxt.textContent = errMsg;
            sendBtn.disabled = true;
            input.style.borderColor = '#dc3545';
        } else {
            warning.style.display = 'none';
            sendBtn.disabled = false;
            input.style.borderColor = '';
        }
    }

    // Blokir keydown untuk angka secara langsung
    input.addEventListener('keydown', function(e) {
        const val = this.value;
        // Cek apakah karakter yang akan ditambahkan akan membentuk rangkaian ≥6 digit
        if (e.key >= '0' && e.key <= '9') {
            const newVal = val.slice(0, this.selectionStart) + e.key + val.slice(this.selectionEnd);
            const noSpace = newVal.replace(/\s+/g, '');
            if (/\d{6,}/.test(noSpace)) {
                e.preventDefault();
                warning.style.display = 'block';
                warningTxt.textContent = 'Tidak boleh memasukkan angka lebih dari 5 digit berurutan.';
                sendBtn.disabled = true;
                return;
            }
        }
    });

    input.addEventListener('input', blockAngka);
    input.addEventListener('paste', function(e) {
        // Cek konten paste
        const pasted = (e.clipboardData || window.clipboardData).getData('text');
        const combined = this.value + pasted;
        const errMsg = checkInput(combined);
        if (errMsg) {
            e.preventDefault();
            warning.style.display = 'block';
            warningTxt.textContent = 'Konten yang ditempel mengandung informasi terlarang: ' + errMsg;
            sendBtn.disabled = true;
        }
    });

    // Validasi sebelum submit
    document.getElementById('chatForm').addEventListener('submit', function(e) {
        const val = input.value;
        const errMsg = checkInput(val);
        if (errMsg) {
            e.preventDefault();
            warning.style.display = 'block';
            warningTxt.textContent = errMsg;
            sendBtn.disabled = true;
        }
    });

    // Auto refresh chat setiap 10 detik
    setInterval(() => {
        fetch('{{ route("chat.messages", $pesanan) }}')
            .then(r => r.json())
            .then(msgs => {
                const box = document.getElementById('chatBox');
                box.innerHTML = '';
                if (msgs.length === 0) {
                    box.innerHTML = `<div class="text-center text-muted py-5" style="font-size:.85rem;">
                        <i class="bi bi-chat-dots fs-2 d-block mb-2 opacity-25"></i>Belum ada pesan.
                    </div>`;
                    return;
                }
                msgs.forEach(m => {
                    const div = document.createElement('div');
                    div.className = 'd-flex ' + (m.is_mine ? 'justify-content-end' : 'justify-content-start');
                    div.innerHTML = `<div class="px-3 py-2 rounded-3" style="max-width:80%;word-break:break-word;${
                        m.is_mine ? 'background:#6C3483;color:#fff;' : 'background:#f0f0f0;color:#333;'
                    }">
                        <div style="font-size:.75rem;opacity:.75;margin-bottom:2px;">${m.pengirim}</div>
                        <div style="font-size:.88rem;">${m.pesan}</div>
                        <div class="text-end" style="font-size:.66rem;opacity:.6;margin-top:3px;">${m.waktu}</div>
                    </div>`;
                    box.appendChild(div);
                });
                box.scrollTop = box.scrollHeight;
            }).catch(() => {});
    }, 10000);
})();
</script>
@endpush
@endonce