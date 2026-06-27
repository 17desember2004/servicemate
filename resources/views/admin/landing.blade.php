<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Landing Page — ServiceMate</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <nav class="bg-blue-700 text-white px-6 py-4 flex justify-between items-center">
        <h1 class="text-xl font-bold">⚙️ ServiceMate Admin</h1>
        <div class="flex gap-4 items-center">
            <a href="/admin" class="text-sm underline">← Dashboard</a>
            <form action="/logout" method="POST">
                @csrf
                <button class="bg-red-500 px-3 py-1 rounded text-sm">Logout</button>
            </form>
        </div>
    </nav>

    <div class="max-w-3xl mx-auto mt-10 px-4 pb-20">
        <h2 class="text-2xl font-bold mb-6">✏️ Edit Landing Page</h2>

        @if(session('success'))
            <div class="mb-4 bg-green-100 text-green-700 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        <form action="/admin/landing" method="POST">
            @csrf

            {{-- HERO SECTION --}}
            <div class="bg-white rounded-xl shadow p-6 mb-6">
                <h3 class="font-bold text-lg mb-4 text-blue-700">🎯 Hero Section</h3>

                <div class="mb-4">
                    <label class="block text-sm font-semibold mb-1">Badge Text</label>
                    <input type="text" name="hero_badge"
                        value="{{ $content['hero_badge'] ?? 'Never miss a service again' }}"
                        class="w-full border rounded px-3 py-2 text-sm">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-semibold mb-1">Hero Title</label>
                    <input type="text" name="hero_title"
                        value="{{ $content['hero_title'] ?? 'Keep Your Vehicle Running Smoothly' }}"
                        class="w-full border rounded px-3 py-2 text-sm">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-semibold mb-1">Hero Subtitle</label>
                    <textarea name="hero_subtitle" rows="3"
                        class="w-full border rounded px-3 py-2 text-sm">{{ $content['hero_subtitle'] ?? 'ServiceMate mengingatkan jadwal servis berdasarkan waktu & kilometer.' }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-semibold mb-1">Tombol CTA</label>
                    <input type="text" name="cta_button"
                        value="{{ $content['cta_button'] ?? 'Start Free Trial' }}"
                        class="w-full border rounded px-3 py-2 text-sm">
                </div>
            </div>

            {{-- FITUR SECTION --}}
            <div class="bg-white rounded-xl shadow p-6 mb-6">
                <h3 class="font-bold text-lg mb-4 text-blue-700">⚡ Fitur Unggulan</h3>

                <div class="mb-4">
                    <label class="block text-sm font-semibold mb-1">Fitur 1</label>
                    <input type="text" name="feature_1"
                        value="{{ $content['feature_1'] ?? 'Pengingat Servis Otomatis' }}"
                        class="w-full border rounded px-3 py-2 text-sm">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-semibold mb-1">Fitur 2</label>
                    <input type="text" name="feature_2"
                        value="{{ $content['feature_2'] ?? 'Tracking Kilometer' }}"
                        class="w-full border rounded px-3 py-2 text-sm">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-semibold mb-1">Fitur 3</label>
                    <input type="text" name="feature_3"
                        value="{{ $content['feature_3'] ?? 'Cari Bengkel Terdekat' }}"
                        class="w-full border rounded px-3 py-2 text-sm">
                </div>
            </div>

            {{-- TESTIMONI SECTION --}}
            <div class="bg-white rounded-xl shadow p-6 mb-6">
                <h3 class="font-bold text-lg mb-4 text-blue-700">💬 Testimoni</h3>

                <div class="mb-4">
                    <label class="block text-sm font-semibold mb-1">Testimoni 1</label>
                    <textarea name="testimoni_1" rows="2"
                        class="w-full border rounded px-3 py-2 text-sm">{{ $content['testimoni_1'] ?? 'Aplikasi ini sangat membantu saya mengelola servis kendaraan!' }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-semibold mb-1">Testimoni 2</label>
                    <textarea name="testimoni_2" rows="2"
                        class="w-full border rounded px-3 py-2 text-sm">{{ $content['testimoni_2'] ?? 'Tidak pernah lagi telat servis berkat ServiceMate.' }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-semibold mb-1">Testimoni 3</label>
                    <textarea name="testimoni_3" rows="2"
                        class="w-full border rounded px-3 py-2 text-sm">{{ $content['testimoni_3'] ?? 'Fitur cari bengkel sangat berguna!' }}</textarea>
                </div>
            </div>

            {{-- KONTAK SECTION --}}
            <div class="bg-white rounded-xl shadow p-6 mb-6">
                <h3 class="font-bold text-lg mb-4 text-blue-700">📞 Kontak & Iklan</h3>

                <div class="mb-4">
                    <label class="block text-sm font-semibold mb-1">No. HP / Telepon</label>
                    <input type="text" name="phone"
                        value="{{ $content['phone'] ?? '' }}"
                        placeholder="contoh: 08123456789"
                        class="w-full border rounded px-3 py-2 text-sm">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-semibold mb-1">WhatsApp</label>
                    <input type="text" name="whatsapp"
                        value="{{ $content['whatsapp'] ?? '' }}"
                        placeholder="contoh: 08123456789"
                        class="w-full border rounded px-3 py-2 text-sm">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-semibold mb-1">Email Kontak</label>
                    <input type="email" name="email_contact"
                        value="{{ $content['email_contact'] ?? '' }}"
                        placeholder="contoh: hello@servicemate.id"
                        class="w-full border rounded px-3 py-2 text-sm">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-semibold mb-1">Teks Iklan / Promo</label>
                    <input type="text" name="iklan_text"
                        value="{{ $content['iklan_text'] ?? '' }}"
                        placeholder="contoh: Coba gratis 14 hari!"
                        class="w-full border rounded px-3 py-2 text-sm">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-semibold mb-1">Link Iklan / Promo</label>
                    <input type="text" name="iklan_url"
                        value="{{ $content['iklan_url'] ?? '' }}"
                        placeholder="contoh: https://servicemate.id/promo"
                        class="w-full border rounded px-3 py-2 text-sm">
                </div>
            </div>

            {{-- FOOTER SECTION --}}
            <div class="bg-white rounded-xl shadow p-6 mb-6">
                <h3 class="font-bold text-lg mb-4 text-blue-700">🔻 Footer</h3>

                <div class="mb-4">
                    <label class="block text-sm font-semibold mb-1">Teks Footer</label>
                    <input type="text" name="footer_text"
                        value="{{ $content['footer_text'] ?? '© 2026 ServiceMate · Made with ❤️ for Indonesia' }}"
                        class="w-full border rounded px-3 py-2 text-sm">
                </div>
            </div>

            <button type="submit"
                class="w-full bg-blue-600 text-white py-3 rounded-xl hover:bg-blue-700 font-bold text-lg">
                💾 Simpan Semua Perubahan
            </button>

        </form>
    </div>

</body>
</html>

