<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('includes.style')
</head>

<body>
    <div id="Content-Container" class="relative flex flex-col w-full max-w-[640px] min-h-screen mx-auto bg-white overflow-x-hidden">

        <!-- component -->
        <div class="flex justify-center items-center p-4 min-h-screen bg-gray-100">
            <div class="p-8 w-full max-w-md bg-white rounded-xl shadow-lg">
                <img src="{{ asset('new/assets/images/icons/logo.svg') }}" class="mx-auto w-auto h-20" alt="icon">
                <h2 class="mt-4 mb-6 text-2xl font-semibold text-center text-gray-900">Daftar</h2>
                <form class="space-y-4">
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-700">Sapaan</label>
                        <select
                            class="px-4 py-2 w-full rounded-lg border border-gray-300 transition-all outline-none focus:ring-2 focus:ring-[#058E2A] focus:border-[#058E2A]">
                            <option value="" disabled selected>Pilih Sapaan</option>
                            <option value="Bapak">Bapak</option>
                            <option value="Ibu">Ibu</option>
                            <option value="Bang">Bang</option>
                            <option value="Kak">Kak</option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <input type="text"
                            class="px-4 py-2 w-full rounded-lg border border-gray-300 transition-all outline-none focus:ring-2 focus:ring-[#058E2A] focus:border-[#058E2A]"
                            placeholder="Masukkan Nama Lengkap" />
                    </div>

                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-700">Nomor WhatsApp</label>
                        <input type="number"
                            class="px-4 py-2 w-full rounded-lg border border-gray-300 transition-all outline-none focus:ring-2 focus:ring-[#058E2A] focus:border-[#058E2A]"
                            placeholder="Masukkan Nomor WhatsApp" />
                    </div>

                    <button
                        class="py-2.5 w-full font-medium text-white bg-[#058E2A] hover:bg-green-500  rounded-lg transition-colors">
                        Daftar Sekarang
                    </button>
                </form>

                <div class="mt-6 text-sm text-center text-gray-600">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="font-medium text-[#058E2A] hover:text-black">Login</a>
                </div>
            </div>
        </div>

    </div>

    @include('includes.script')
</body>

</html>
