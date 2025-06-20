<div class="bg-white p-6 rounded-xl shadow mb-6">
    <h3 class="text-lg font-semibold text-gray-800 mb-2">Ubah Email</h3>
    <p class="text-sm text-gray-600 mb-4 flex items-center gap-2">
        Pastikan email kamu aktif & valid agar bisa menerima notifikasi dari sistem.
    </p>

    <form wire:submit.prevent="updateProfileInformation" class="space-y-4 text-sm text-gray-700">
        <div>
            <label for="email" class="block text-black text-xs mb-1">Email</label>
            <input wire:model.defer="email" id="email" type="email"
                class="w-full border border-gray-200 shadow-sm rounded-md p-2 focus:ring focus:ring-blue-100 focus:outline-none"
                required autocomplete="email">
            <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-red-600 text-xs mt-1"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->

            <!--[if BLOCK]><![endif]--><?php if(auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! auth()->user()->hasVerifiedEmail()): ?>
                <div class="mt-2 text-xs text-gray-700">
                    Email Anda belum diverifikasi.
                    <button wire:click.prevent="sendVerification"
                        class="underline text-indigo-600 hover:text-indigo-800">
                        Klik di sini untuk kirim ulang email verifikasi.
                    </button>

                    <!--[if BLOCK]><![endif]--><?php if(session('status') === 'verification-link-sent'): ?>
                        <p class="mt-2 text-green-600 font-medium">
                            Link verifikasi baru telah dikirim ke email Anda.
                        </p>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                </div>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
        </div>

        <div class="flex justify-end mt-4">
            <button type="submit"
                class="bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium py-2 px-4 rounded-md shadow-sm transition duration-150 ease-in-out">
                Simpan
            </button>
        </div>
    </form>
</div><?php /**PATH C:\Users\ASUS\perpustakaan\resources\views\livewire/admin/profile/update-profile-information-form.blade.php ENDPATH**/ ?>