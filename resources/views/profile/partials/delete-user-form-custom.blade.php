 {{-- KARTU UNTUK HAPUS AKUN --}}
 <div class="card shadow-sm border-danger">
     <div class="card-header bg-danger text-white">
         <h5 class="mb-0">Hapus Akun</h5>
     </div>
     <div class="card-body">
         <p>Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen. Sebelum menghapus
             akun Anda, harap unduh data atau informasi apa pun yang
             ingin Anda simpan.</p>

         {{-- Tombol ini akan memunculkan modal konfirmasi --}}
         <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirm-user-deletion">
             Hapus Akun Saya
         </button>
     </div>
 </div>

 <div class="modal fade" id="confirm-user-deletion" tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <form method="post" action="{{ route('profile.destroy') }}" class="modal-content">
             @csrf
             @method('delete')

             <div class="modal-header">
                 <h5 class="modal-title">Apakah Anda yakin?</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <p>Setelah akun Anda dihapus, semua datanya tidak dapat dikembalikan. Silakan masukkan password Anda
                     untuk mengonfirmasi bahwa Anda ingin menghapus akun Anda secara permanen.</p>
                 <div class="form-group">
                     <label for="password-delete">Password</label>
                     <div class="input-group">
                         <input id="password-delete" name="password" type="password" class="form-control"
                             placeholder="Password">
                         <div class="input-group-append">
                             <button class="btn btn-outline-secondary toggle-password" type="button"
                                 data-target="password-delete">
                                 <i class="fa fa-eye"></i>
                             </button>
                         </div>
                     </div>
                     @error('password', 'userDeletion')
                         <small class="text-danger">{{ $message }}</small>
                     @enderror
                 </div>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                 <button type="submit" class="btn btn-danger">Hapus Akun</button>
             </div>
         </form>
     </div>
 </div>
