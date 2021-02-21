<script type="text/javascript">
	$(function() {
		var typeNotif = '<?php echo $this->session->userdata('typeNotif'); ?>';
		switch (typeNotif) {
			case 'successEdited':
				var icon = $('#alerttitle').html();
				$('#alerttitle').html(icon + "Sukses");
				$('#alertmessage').text("Perubahan data berhasil");
				$('#alerttitle').addClass("text-success");
				$('#alerttype').addClass("alert-success");
				$('#alerticon').addClass("fa fa-check-circle");
				break;
			case 'errorEdited':
				var icon = $('#alerttitle').html();
				$('#alerttitle').html(icon + "Gagal");
				$('#alertmessage').text("Perubahan data gagal");
				$('#alerttitle').addClass("tx-danger");
				$('#alerttype').addClass("alert-danger");
				$('#alerticon').addClass("fas fa-exclamation-triangle");
				break;
			case 'successResetPassword':
				$('#alerttitle').text("Pembaruan password sukses");
				$('#alerttitle').addClass("tx-success");
				$('#alertmessage').text("Silahkan login kembali");
				$('#alerttype').addClass("alert-success");
				$('#alerticon').addClass("ion-ios-checkmark tx-success");
				break;
			case 'successAddUser':
				var icon = $('#alerttitle').html();
				$('#alerttitle').html(icon + "Sukses");
				$('#alertmessage').text("Berhasil menambah pengguna");
				$('#alerttitle').addClass("text-success");
				$('#alerttype').addClass("alert-success");
				$('#alerticon').addClass("fa fa-check-circle");
				break;
			case 'errorAddUser':
				var icon = $('#alerttitle').html();
				$('#alerttitle').html(icon + "Gagal!");
				$('#alerttitle').addClass("tx-danger");
				$('#alertmessage').text("Gagal menembahkan pengguna");
				$('#alerttype').addClass("alert-danger");
				$('#alerticon').addClass("fas fa-exclamation-triangle");
				break;
			case 'usernameAlreadyExist':
				$('#alerttitle').text("Username telah digunakan");
				$('#alerttitle').addClass("tx-danger");
				$('#alertmessage').text("Silahkan mendaftar dengan username lain");
				$('#alerttype').addClass("alert-danger");
				$('#alerticon').addClass("ion-ios-close tx-danger");
				break;
			case 'usernameAlreadyExistOnUserManagement':
				var icon = $('#alerttitle').html();
				$('#alerttitle').html(icon + "Gagal!");
				$('#alerttitle').addClass("tx-danger");
				$('#alertmessage').text("Username telah digunakan, silahkan gunakan username lain");
				$('#alerttype').addClass("alert-danger");
				$('#alerticon').addClass("fas fa-exclamation-triangle");
				break;
			case 'emailAlreadyExist':
				$('#alerttitle').text("Email telah digunakan");
				$('#alerttitle').addClass("tx-danger");
				$('#alertmessage').text("Silahkan mendaftar dengan email lain");
				$('#alerttype').addClass("alert-danger");
				$('#alerticon').addClass("ion-ios-close tx-danger");
				break;
			case 'emailAlreadyExistOnUserManagement':
				var icon = $('#alerttitle').html();
				$('#alerttitle').html(icon + "Gagal!");
				$('#alerttitle').addClass("tx-danger");
				$('#alertmessage').text("Email telah digunakan, silahkan gunakan email lain");
				$('#alerttype').addClass("alert-danger");
				$('#alerticon').addClass("fas fa-exclamation-triangle");
				break;
			case 'usernameAndEmailAlreadyExist':
				$('#alerttitle').text("Username maupun Email telah digunakan");
				$('#alerttitle').addClass("tx-danger");
				$('#alertmessage').text("Silahkan mendaftar dengan username dan email lain");
				$('#alerttype').addClass("alert-danger");
				$('#alerticon').addClass("ion-ios-close tx-danger");
				break;
			case 'usernameAndEmailAlreadyExistOnUserManagement':
				var icon = $('#alerttitle').html();
				$('#alerttitle').html(icon + "Gagal!");
				$('#alerttitle').addClass("tx-danger");
				$('#alertmessage').text("Username maupun email telah digunakan, silahkan gunakan username dan email lain");
				$('#alerttype').addClass("alert-danger");
				$('#alerticon').addClass("fas fa-exclamation-triangle");
				break;
			case 'res_nameAlreadyExist':
				$('#alerttitle').text("Nama Resources telah digunakan !");
				$('#alerttitle').addClass("tx-danger");
				$('#alertmessage').text("Gunakan nama resources lain !");
				$('#alerttype').addClass("alert-danger");
				$('#alerticon').addClass("ion-ios-close tx-danger");
				break;
			case 'res_codeAlreadyExist':
				$('#alerttitle').text("Kode Resources telah digunakan !");
				$('#alerttitle').addClass("tx-danger");
				$('#alertmessage').text("Gunakan kode resources lain !");
				$('#alerttype').addClass("alert-danger");
				$('#alerticon').addClass("ion-ios-close tx-danger");
				break;
			case 'res_nameAndres_codeAlreadyExist':
				$('#alerttitle').text("Nama maupun Kode Resources telah digunakan");
				$('#alerttitle').addClass("tx-danger");
				$('#alertmessage').text("Silahkan gunakan nama dan kode Resources lain !");
				$('#alerttype').addClass("alert-danger");
				$('#alerticon').addClass("ion-ios-close tx-danger");
				break;
			case 'ba_nameAlreadyExist':
				$('#alerttitle').text("Nama Base Application telah digunakan !");
				$('#alerttitle').addClass("tx-danger");
				$('#alertmessage').text("Gunakan nama Base Application lain !");
				$('#alerttype').addClass("alert-danger");
				$('#alerticon').addClass("ion-ios-close tx-danger");
				break;
			case 'ba_codeAlreadyExist':
				$('#alerttitle').text("Kode Base Application telah digunakan !");
				$('#alerttitle').addClass("tx-danger");
				$('#alertmessage').text("Gunakan kode Base Application lain !");
				$('#alerttype').addClass("alert-danger");
				$('#alerticon').addClass("ion-ios-close tx-danger");
				break;
			case 'ba_nameAndba_codeAlreadyExist':
				$('#alerttitle').text("Nama maupun Kode Base Application telah digunakan");
				$('#alerttitle').addClass("tx-danger");
				$('#alertmessage').text("Silahkan gunakan nama dan kode Base Application lain !");
				$('#alerttype').addClass("alert-danger");
				$('#alerticon').addClass("ion-ios-close tx-danger");
				break;
			case 'adminSuccessActivate':
				var icon = $('#alerttitle').html();
				$('#alerttitle').html(icon + "Sukses");
				$('#alertmessage').text("Pengguna berhasil diaktifkan");
				$('#alerttitle').addClass("text-success");
				$('#alerttype').addClass("alert-success");
				$('#alerticon').addClass("fa fa-check-circle");
				break;
			case 'adminErrorActivate':
				var icon = $('#alerttitle').html();
				$('#alerttitle').html(icon + "Gagal!");
				$('#alerttitle').addClass("tx-danger");
				$('#alertmessage').text("Gagal mengaktifkan pengguna");
				$('#alerttype').addClass("alert-danger");
				$('#alerticon').addClass("fas fa-exclamation-triangle");
				break;
			case 'successDelete':
				$('#alerttitle').text("User berhasil dihapus!");
				$('#alerttitle').addClass("tx-success");
				$('#alerttype').addClass("alert-success");
				$('#alerticon').addClass("ion-ios-checkmark tx-success");
				break;
			case 'errorDelete':
				$('#alerttitle').text("User gagal dihapus!");
				$('#alerttitle').addClass("tx-danger");
				$('#alerttype').addClass("alert-danger");
				$('#alerticon').addClass("ion-ios-close tx-danger");
				break;
			case 'adminSuccessNonactivate':
				$('#alerttitle').text("User berhasil dinonaktifkan");
				$('#alerttitle').addClass("tx-success");
				$('#alerttype').addClass("alert-success");
				$('#alerticon').addClass("ion-ios-close tx-danger");
				break;
			case 'adminErrorNonactiavte':
				$('#alerttitle').text("User gagal diaktifkan!");
				$('#alerttitle').addClass("tx-danger");
				$('#alerttype').addClass("alert-danger");
				$('#alerticon').addClass("ion-ios-close tx-danger");
				break;
			case 'successActivate':
				$('#alerttitle').text("Aktivasi akun berhasil");
				$('#alerttitle').addClass("tx-success");
				$('#alertmessage').text("Anda sudah dapat mengakses website Fist Effect");
				$('#alerttype').addClass("alert-success");
				$('#alerticon').addClass("ion-ios-checkmark tx-success");
				break;
			case 'hasActivate':
				$('#alerttitle').text("Akun sudah teraktivasi");
				$('#alerttitle').addClass("tx-success");
				$('#alertmessage').text("Anda sudah dapat mengakses website Fist Effect");
				$('#alerttype').addClass("alert-success");
				$('#alerticon').addClass("ion-ios-checkmark tx-success");
				break;
			case 'userNotFound':
				$('#alerttitle').text("User tidak ditemukan");
				$('#alerttitle').addClass("tx-danger");
				$('#alertmessage').text("Cek username atau email Anda");
				$('#alerttype').addClass("alert-danger");
				$('#alerticon').addClass("ion-ios-close tx-danger");
				break;
			case 'userNotActive':
				$('#alerttitle').text("Akun Anda belum diaktivasi");
				$('#alerttitle').addClass("tx-danger");
				$('#alertmessage').text("Cek email Anda untuk melakukan aktivasi");
				$('#alerttype').addClass("alert-danger");
				$('#alerticon').addClass("ion-ios-close tx-danger");
				break;
			case 'wrongPassword':
				$('#alerttitle').text("Password salah");
				$('#alerttitle').addClass("tx-danger");
				$('#alertmessage').text("Periksa kembali password yang Anda masukkan");
				$('#alerttype').addClass("alert-danger");
				$('#alerticon').addClass("ion-ios-close tx-danger");
				break;
			case 'successResetPassword':
				$('#alerttitle').text("Reset password berhasil");
				$('#alerttitle').addClass("tx-success");
				$('#alertmessage').text("Anda dapat mengakses akun kembali");
				$('#alerttype').addClass("alert-success");
				$('#alerticon').addClass("ion-ios-checkmark tx-success");
				break;
			case 'errorResetPassword':
				$('#alerttitle').text("Reset password gagal");
				$('#alerttitle').addClass("tx-danger");
				$('#alertmessage').text("Mohon ulangi proses reset password atau hubungi admin");
				$('#alerttype').addClass("alert-danger");
				$('#alerticon').addClass("ion-ios-close tx-danger");
				break;
			case 'successEmailActivate':
				$('#alerttitle').text("Email aktivasi sudah dikirim");
				$('#alerttitle').addClass("tx-success");
				$('#alertmessage').text("Silahkan periksa email untuk melakukan aktivasi");
				$('#alerttype').addClass("alert-success");
				$('#alerticon').addClass("ion-ios-checkmark tx-success");
				break;
			case 'failedEmailActivate':
				$('#alerttitle').text("Email aktivasi gagal dikirim");
				$('#alerttitle').addClass("tx-danger");
				$('#alertmessage').text("Harap periksa kembali email yang Anda gunakan untuk registrasi atau hubungi admin");
				$('#alerttype').addClass("alert-danger");
				$('#alerticon').addClass("ion-ios-close tx-danger");
				break;
			case 'resetHasSend':
				$('#alerttitle').text("Proses reset password sudah dikirim ke email Anda");
				$('#alerttitle').addClass("tx-success");
				$('#alertmessage').text("Silahkan cek email untuk mengikuti instruksi mengenai penggantian password");
				$('#alerttype').addClass("alert-success");
				$('#alerticon').addClass("ion-ios-checkmark tx-success");
				break;
			case 'usernameAlreadyExist':
				$('#alerttitle').text("Username telah digunakan");
				$('#alerttitle').addClass("tx-danger");
				$('#alertmessage').text("Silahkan mendaftar dengan username lain");
				$('#alerttype').addClass("alert-danger");
				$('#alerticon').addClass("ion-ios-close tx-danger");
				break;
			case 'emailAlreadyExist':
				$('#alerttitle').text("Email telah digunakan");
				$('#alerttitle').addClass("tx-danger");
				$('#alertmessage').text("Silahkan mendaftar dengan email lain");
				$('#alerttype').addClass("alert-danger");
				$('#alerticon').addClass("ion-ios-close tx-danger");
				break;
			case 'usernameAndEmailAlreadyExist':
				$('#alerttitle').text("Username maupun Email telah digunakan");
				$('#alerttitle').addClass("tx-danger");
				$('#alertmessage').text("Silahkan mendaftar dengan username dan email lain");
				$('#alerttype').addClass("alert-danger");
				$('#alerticon').addClass("ion-ios-close tx-danger");
				break;
			case 'tokenExpired':
				$('#alerttitle').text("Token sudah kadaluarsa");
				$('#alerttitle').addClass("tx-danger");
				$('#alertmessage').text("Lakukan reset password kembali dan segera ganti password setelah mendapatkan email");
				$('#alerttype').addClass("alert-danger");
				$('#alerticon').addClass("ion-ios-close tx-danger");
				break;
			case 'successEditedProfile':
				var icon = $('#alerttitle').html();
				$('#alerttitle').html(icon + "Sukses");
				$('#alertmessage').text("Berhasil memperbarui profil");
				$('#alerttitle').addClass("text-success");
				$('#alerttype').addClass("alert-success");
				$('#alerticon').addClass("fa fa-check-circle");
				break;
			case 'errorEditedProfile':
				$('#alerttitle').text("Gagal memperbarui profil");
				$('#alerttitle').addClass("tx-danger");
				$('#alerttype').addClass("alert-danger");
				$('#alerticon').addClass("ion-ios-close tx-danger");
				break;
			case 'successSuspend':
				$('#alerttitle').text("Berhasil melakukan suspend terhadap akun");
				$('#alerttitle').addClass("tx-success");
				$('#alertmessage').text("Akun tidak dapat digunakan untuk login. Hubungi administrator agar dapat login kembali");
				$('#alerttype').addClass("alert-success");
				$('#alerticon').addClass("ion-ios-chckmark tx-success");
				break;
			case 'errorSuspend':
				$('#alerttitle').text("Gagal melakukan suspend terhadap akun");
				$('#alerttitle').addClass("tx-danger");
				$('#alerttype').addClass("alert-danger");
				$('#alerticon').addClass("ion-ios-close tx-danger");
				break;
			case 'userHasSuspend':
				$('#alerttitle').text("Akun sedang disuspend");
				$('#alerttitle').addClass("tx-danger");
				$('#alertmessage').text("Hubungi administrator agar dapat login");
				$('#alerttype').addClass("alert-danger");
				$('#alerticon').addClass("ion-ios-clode tx-danger");
				break;
			case 'successSuspendFromAdmin':
				var icon = $('#alerttitle').html();
				$('#alerttitle').html(icon + "Sukses");
				$('#alertmessage').text("Berhasil melakukan suspend pada pengguna");
				$('#alerttitle').addClass("text-success");
				$('#alerttype').addClass("alert-success");
				$('#alerticon').addClass("fa fa-check-circle");
				break;
			case 'successUnsuspendFromAdmin':
				var icon = $('#alerttitle').html();
				$('#alerttitle').html(icon + "Sukses");
				$('#alertmessage').text("Berhasil melakukan unsuspend pada pengguna");
				$('#alerttitle').addClass("text-success");
				$('#alerttype').addClass("alert-success");
				$('#alerticon').addClass("fa fa-check-circle");
				break;
			case 'successChangePassword':
				var icon = $('#alerttitle').html();
				$('#alerttitle').html(icon + "Sukses");
				$('#alertmessage').text("Password berhasil diubah");
				$('#alerttitle').addClass("text-success");
				$('#alerttype').addClass("alert-success");
				$('#alerticon').addClass("fa fa-check-circle");
				break;
			case 'wrongRecentPassword':
				var icon = $('#alerttitle').html();
				$('#alerttitle').html(icon + "Gagal");
				$('#alertmessage').text("Password lama yang Anda masukkan salah");
				$('#alerttitle').addClass("tx-danger");
				$('#alerttype').addClass("alert-danger");
				$('#alerticon').addClass("fas fa-exclamation-triangle");
				break;
			case 'notLoggedIn':
				$('#alerttitle').text("Anda Belum Login!");
				$('#alerttitle').addClass("tx-danger");
				$('#alertmessage').text("Silahkan login terlebih dahulu");
				$('#alerttype').addClass("alert-danger");
				$('#alerticon').addClass("ion-ios-close tx-danger");
				break;
			case 'fulfillProfile':
				var icon = $('#alerttitle').html();
				$('#alerttitle').html(icon + "Profile Belum Lengkap");
				$('#alertmessage').text("Lengkapi Profile Dahulu!");
				$('#alerttitle').addClass("tx-danger");
				$('#alerttype').addClass("alert-danger");
				$('#alerticon').addClass("fa fa-ban");
				break;
			case 'fileHasSent':
				var icon = $('#alerttitle').html();
				$('#alerttitle').html(icon + "Sukses");
				$('#alerttitle').addClass("tx-info");
				$('#alertmessage').text("Email telah terkirim. Cek Email Anda !");
				$('#alerttype').addClass("alert-info");
				$('#alerticon').addClass("fa fa-check-circle");
				break;
			case 'fileDownloaded':
				var icon = $('#alerttitle').html();
				$('#alerttitle').html(icon + "Sukses");
				$('#alerttitle').addClass("tx-info");
				$('#alertmessage').text("File telah didownload !");
				$('#alerttype').addClass("alert-info");
				$('#alerticon').addClass("fa fa-check-circle");
				break;
			case 'successAddData':
				var icon = $('#alerttitle').html();
				$('#alerttitle').html(icon + "Sukses");
				$('#alertmessage').text("Berhasil menambahkan data");
				$('#alerttitle').addClass("text-success");
				$('#alerttype').addClass("alert-success");
				$('#alerticon').addClass("fa fa-check-circle");
				break;
			case 'errorAddData':
				var icon = $('#alerttitle').html();
				$('#alerttitle').html(icon + "Gagal!");
				$('#alerttitle').addClass("tx-danger");
				$('#alertmessage').text("Gagal menambahkan data");
				$('#alerttype').addClass("alert-danger");
				$('#alerticon').addClass("fas fa-exclamation-triangle");
				break;
			case 'successEditData':
				var icon = $('#alerttitle').html();
				$('#alerttitle').html(icon + "Sukses");
				$('#alertmessage').text("Berhasil memperbarui data");
				$('#alerttitle').addClass("text-success");
				$('#alerttype').addClass("alert-success");
				$('#alerticon').addClass("fa fa-check-circle");
				break;
			case 'errorEditData':
				var icon = $('#alerttitle').html();
				$('#alerttitle').html(icon + "Gagal!");
				$('#alerttitle').addClass("tx-danger");
				$('#alertmessage').text("Gagal memperbarui data");
				$('#alerttype').addClass("alert-danger");
				$('#alerticon').addClass("fas fa-exclamation-triangle");
				break;
			case 'successDeleteData':
				var icon = $('#alerttitle').html();
				$('#alerttitle').html(icon + "Sukses");
				$('#alertmessage').text("Berhasil menghapus data");
				$('#alerttitle').addClass("text-success");
				$('#alerttype').addClass("alert-success");
				$('#alerticon').addClass("fa fa-check-circle");
				break;
			case 'errorDeleteData':
				var icon = $('#alerttitle').html();
				$('#alerttitle').html(icon + "Gagal!");
				$('#alerttitle').addClass("tx-danger");
				$('#alertmessage').text("Gagal menghapus data");
				$('#alerttype').addClass("alert-danger");
				$('#alerticon').addClass("fas fa-exclamation-triangle");
				break;
			case 'emailHasSent':
				var icon = $('#alerttitle').html();
				$('#alerttitle').html(icon + "Sukses");
				$('#alertmessage').text("Email Berhasil Dikirim !");
				$('#alerttitle').addClass("tx-success");
				$('#alerttype').addClass("alert-success");
				$('#alerticon').addClass("fa fa-check-circle");
				break;
			case 'emailFail':
				var icon = $('#alerttitle').html();
				$('#alerttitle').html(icon + "Gagal");
				$('#alertmessage').text("Email Gagal Dikirim!");
				$('#alerttitle').addClass("tx-danger");
				$('#alerttype').addClass("alert-danger");
				$('#alerticon').addClass("fa fa-ban");
				break;
			case 'resourcesUsed':
				var icon = $('#alerttitle').html();
				$('#alerttitle').html(icon + "Gagal");
				$('#alertmessage').text("Resources Sedang Digunakan!");
				$('#alerttitle').addClass("tx-danger");
				$('#alerttype').addClass("alert-danger");
				$('#alerticon').addClass("fa fa-ban");
				break;
			case 'applicationUsed':
				var icon = $('#alerttitle').html();
				$('#alerttitle').html(icon + "Gagal");
				$('#alertmessage').text("Aplikasi Sedang Digunakan!");
				$('#alerttitle').addClass("tx-danger");
				$('#alerttype').addClass("alert-danger");
				$('#alerticon').addClass("fa fa-ban");
				break;
			case 'packageAlreadyExist':
				var icon = $('#alerttitle').html();
				$('#alerttitle').html(icon + "Gagal");
				$('#alertmessage').text("Paket Sudah Tersedia!");
				$('#alerttitle').addClass("tx-danger");
				$('#alerttype').addClass("alert-danger");
				$('#alerticon').addClass("fa fa-ban");
				break;
			case 'periodeAlreadyExist':
				var icon = $('#alerttitle').html();
				$('#alerttitle').html(icon + "Gagal");
				$('#alertmessage').text("Periode Sudah Tersedia!");
				$('#alerttitle').addClass("tx-danger");
				$('#alerttype').addClass("alert-danger");
				$('#alerticon').addClass("fa fa-ban");
				break;
			case 'periodeActive':
				var icon = $('#alerttitle').html();
				$('#alerttitle').html(icon + "Sukses");
				$('#alertmessage').text("Periode Diaktifkan");
				$('#alerttitle').addClass("tx-success");
				$('#alerttype').addClass("alert-success");
				$('#alerticon').addClass("fa fa-check-circle");
				break;
			case 'periodeAdded':
				var icon = $('#alerttitle').html();
				$('#alerttitle').html(icon + "Sukses");
				$('#alertmessage').text("Periode Berhasil Ditambah");
				$('#alerttitle').addClass("tx-success");
				$('#alerttype').addClass("alert-success");
				$('#alerticon').addClass("fa fa-check-circle");
				break;
			case 'successDeleteFeedback':
				var icon = $('#alerttitle').html();
				$('#alerttitle').html(icon + "Sukses");
				$('#alertmessage').text("Saran Berhasil dihapus!");
				$('#alerttitle').addClass("tx-success");
				$('#alerttype').addClass("alert-success");
				$('#alerticon').addClass("fa fa-check-circle");
				break;
			case 'errorDeleteFeedback':
				var icon = $('#alerttitle').html();
				$('#alerttitle').html(icon + "Gagal");
				$('#alertmessage').text("Saran gagal dihapus!");
				$('#alerttitle').addClass("tx-danger");
				$('#alerttype').addClass("alert-danger");
				$('#alerticon').addClass("fa fa-ban");
				break;
			case 'successEditFeedback':
				var icon = $('#alerttitle').html();
				$('#alerttitle').html(icon + "Sukses");
				$('#alertmessage').text("Perubahan Feedback berhasil disimpan");
				$('#alerttitle').addClass("tx-success");
				$('#alerttype').addClass("alert-success");
				$('#alerticon').addClass("fa fa-check-circle");
				break;
			case 'errorEditFeedback':
				var icon = $('#alerttitle').html();
				$('#alerttitle').html(icon + "Gagal");
				$('#alerttitle').addClass("tx-danger");
				$('#alertmessage').text("Gagal Mengubah Feedback! Feedback ini sudah ada yang menjawab");
				$('#alerttype').addClass("alert-danger");
				$('#alerticon').addClass("fa fa-ban");
				break;
			case 'packageAdded':
				var icon = $('#alerttitle').html();
				$('#alerttitle').html(icon + "Sukses");
				$('#alertmessage').text("Paket Berhasil Ditambah");
				$('#alerttitle').addClass("tx-success");
				$('#alerttype').addClass("alert-success");
				$('#alerticon').addClass("fa fa-check-circle");
				break;
			case 'deleteAvailable':
				var icon = $('#alerttitle').html();
				$('#alerttitle').html(icon + "Sukses");
				$('#alertmessage').text("Paket Berhasil Dihapus");
				$('#alerttitle').addClass("tx-success");
				$('#alerttype').addClass("alert-success");
				$('#alerticon').addClass("fa fa-check-circle");
				break;
			case 'deletePeriode':
				var icon = $('#alerttitle').html();
				$('#alerttitle').html(icon + "Sukses");
				$('#alertmessage').text("Periode Berhasil Dihapus");
				$('#alerttitle').addClass("tx-success");
				$('#alerttype').addClass("alert-success");
				$('#alerticon').addClass("fa fa-check-circle");
				break;
			case 'periodeUsed':
				var icon = $('#alerttitle').html();
				$('#alerttitle').html(icon + "Gagal");
				$('#alertmessage').text("Periode Sedang Digunakan!");
				$('#alerttitle').addClass("tx-danger");
				$('#alerttype').addClass("alert-danger");
				$('#alerticon').addClass("fa fa-ban");
				break;
			case 'packageUsed':
				var icon = $('#alerttitle').html();
				$('#alerttitle').html(icon + "Gagal");
				$('#alertmessage').text("Paket Sedang Digunakan!");
				$('#alerttitle').addClass("tx-danger");
				$('#alerttype').addClass("alert-danger");
				$('#alerticon').addClass("fa fa-ban");
				break;
			case 'successActivateWorksem':
				var icon = $('#alerttitle').html();
				$('#alerttitle').html(icon + "Sukses");
				$('#alertmessage').text("Berhasil mengaktifkan workshop atau seminar");
				$('#alerttitle').addClass("text-success");
				$('#alerttype').addClass("alert-success");
				$('#alerticon').addClass("fa fa-check-circle");
				break;
			case 'successDeactivateWorksem':
				var icon = $('#alerttitle').html();
				$('#alerttitle').html(icon + "Sukses");
				$('#alertmessage').text("Berhasil menonaktifkan workshop atau seminar");
				$('#alerttitle').addClass("text-success");
				$('#alerttype').addClass("alert-success");
				$('#alerticon').addClass("fa fa-check-circle");
				break;
			case 'anyParticipantOnWS':
				var icon = $('#alerttitle').html();
				$('#alerttitle').html(icon + "Peringatan");
				$('#alertmessage').text("Tidak dapat mengedit pertanyaan karena sudah terdapat partisipan yang mendaftar");
				$('#alerttitle').addClass("text-warning");
				$('#alerttype').addClass("alert-warning");
				$('#alerticon').addClass("fa fa-exclamation-triangle");
				break;
				//Module Management
			case 'module-berhasil-update':
				var icon = $('#alerttitle').html();
				$('#alerttitle').html(icon + "Berhasil");
				$('#alertmessage').text("Perubahan data berhasil");
				$('#alerttitle').addClass("text-success");
				$('#alerttype').addClass("alert-success");
				$('#alerticon').addClass("fa fa-check-circle");
				break;
			case 'module-gagal-update':
				var icon = $('#alerttitle').html();
				$('#alerttitle').html(icon + "Gagal Memperbaharui!");
				$('#alerttitle').addClass("tx-danger");
				$('#alertmessage').text("Pastikan format dan ukuran file sesuai");
				$('#alerttype').addClass("alert-danger");
				$('#alerticon').addClass("fas fa-exclamation-triangle");
				break;
			case 'module-berhasil-tambah':
				var icon = $('#alerttitle').html();
				$('#alerttitle').html(icon + "Berhasil");
				$('#alertmessage').text("Module Berhasil ditambah");
				$('#alerttitle').addClass("text-success");
				$('#alerttype').addClass("alert-success");
				$('#alerticon').addClass("fa fa-check-circle");
				break;
			case 'module-gagal-tambah1':
				var icon = $('#alerttitle').html();
				$('#alerttitle').html(icon + "Gagal!");
				$('#alerttitle').addClass("tx-danger");
				$('#alertmessage').text("Pastikan format dan ukuran file sesuai");
				$('#alerttype').addClass("alert-danger");
				$('#alerticon').addClass("fas fa-exclamation-triangle");
				break;
			case 'module-berhasil-delete':
				var icon = $('#alerttitle').html();
				$('#alerttitle').html(icon + "Berhasil");
				$('#alertmessage').text("Module Berhasil Dihapus");
				$('#alerttitle').addClass("text-success");
				$('#alerttype').addClass("alert-success");
				$('#alerticon').addClass("fa fa-check-circle");
				break;
			case 'successAddCollege':
				var icon = $('#alerttitle').html();
				$('#alerttitle').html(icon + "Sukses");
				$('#alertmessage').text("Berhasil menambahkan kampus");
				$('#alerttitle').addClass("text-success");
				$('#alerttype').addClass("alert-success");
				$('#alerticon').addClass("fa fa-check-circle");
				break;
			case 'failedAddCollege':
				var icon = $('#alerttitle').html();
				$('#alerttitle').html(icon + "Gagal!");
				$('#alerttitle').addClass("tx-danger");
				$('#alertmessage').text("Gagal menambahkan kampus");
				$('#alerttype').addClass("alert-danger");
				$('#alerticon').addClass("fas fa-exclamation-triangle");
				break;
			case 'successDeleteCollege':
				var icon = $('#alerttitle').html();
				$('#alerttitle').html(icon + "Sukses");
				$('#alertmessage').text("Berhasil menghapus kampus");
				$('#alerttitle').addClass("text-success");
				$('#alerttype').addClass("alert-success");
				$('#alerticon').addClass("fa fa-check-circle");
				break;
			case 'failedDeleteCollege':
				var icon = $('#alerttitle').html();
				$('#alerttitle').html(icon + "Gagal!");
				$('#alerttitle').addClass("tx-danger");
				$('#alertmessage').text("Gagal menghapus kampus");
				$('#alerttype').addClass("alert-danger");
				$('#alerticon').addClass("fas fa-exclamation-triangle");
				break;
			case 'successUpdateCollege':
				var icon = $('#alerttitle').html();
				$('#alerttitle').html(icon + "Sukses");
				$('#alertmessage').text("Berhasil memperbarui data kampus");
				$('#alerttitle').addClass("text-success");
				$('#alerttype').addClass("alert-success");
				$('#alerticon').addClass("fa fa-check-circle");
				break;
			case 'failedUpdateCollege':
				var icon = $('#alerttitle').html();
				$('#alerttitle').html(icon + "Gagal!");
				$('#alerttitle').addClass("tx-danger");
				$('#alertmessage').text("Gagal memperbarui data kampus");
				$('#alerttype').addClass("alert-danger");
				$('#alerticon').addClass("fas fa-exclamation-triangle");
				break;
			case 'collegeHasUsed':
				var icon = $('#alerttitle').html();
				$('#alerttitle').html(icon + "Gagal!");
				$('#alerttitle').addClass("tx-danger");
				$('#alertmessage').text("Tidak dapat menghapus kampus karena data kampus sedang digunakan");
				$('#alerttype').addClass("alert-danger");
				$('#alerticon').addClass("fas fa-exclamation-triangle");
				break;
			case 'successAddWorkshopSeminar':
				var icon = $('#alerttitle').html();
				$('#alerttitle').html(icon + "Sukses");
				$('#alertmessage').text("Berhasil menambahkan kegiatan");
				$('#alerttitle').addClass("text-success");
				$('#alerttype').addClass("alert-success");
				$('#alerticon').addClass("fa fa-check-circle");
				break;
			case 'successUpdatePayment':
				var icon = $('#alerttitle').html();
				$('#alerttitle').html(icon + "Sukses");
				$('#alertmessage').text("Berhasil memperbarui status pembayaran");
				$('#alerttitle').addClass("text-success");
				$('#alerttype').addClass("alert-success");
				$('#alerticon').addClass("fa fa-check-circle");
				break;
			case 'failedUpdatePayment':
				var icon = $('#alerttitle').html();
				$('#alerttitle').html(icon + "Gagal!");
				$('#alerttitle').addClass("tx-danger");
				$('#alertmessage').text("Gagal memperbarui status pembayaran");
				$('#alerttype').addClass("alert-danger");
				$('#alerticon').addClass("fas fa-exclamation-triangle");
				break;
			case 'successUpdateAttendance':
				var icon = $('#alerttitle').html();
				$('#alerttitle').html(icon + "Sukses");
				$('#alertmessage').text("Berhasil memperbarui status kedatangan");
				$('#alerttitle').addClass("text-success");
				$('#alerttype').addClass("alert-success");
				$('#alerticon').addClass("fa fa-check-circle");
				break;
			case 'failedUpdateAttendance':
				var icon = $('#alerttitle').html();
				$('#alerttitle').html(icon + "Gagal!");
				$('#alerttitle').addClass("tx-danger");
				$('#alertmessage').text("Gagal memperbarui status kedatangan");
				$('#alerttype').addClass("alert-danger");
				$('#alerticon').addClass("fas fa-exclamation-triangle");
				break;
			case 'successAddPresenceTraining':
				$('#alertmessage').text("Berhasil menambahkan Presensi Mahasiswa Kelas Training");
				$('#alerttitle').addClass("tx-success");
				$('#alerttype').addClass("alert-success");
				$('#alerticon').addClass("fa fa-check-circle");
				break;
			case 'successDeletePresenceTraining':
				$('#alerttitle').text("Data berhasil dihapus!");
				$('#alerttitle').addClass("tx-success");
				$('#alerttype').addClass("alert-success");
				$('#alerticon').addClass("ion-ios-checkmark tx-success");
				break;
			case 'successUpdatePresenceTraining':
				$('#alerttitle').text("Perubahan berhasil");
				$('#alerttitle').addClass("tx-success");
				$('#alertmessage').text("Perubahan Data Presensi berhasil");
				$('#alerttype').addClass("alert-success");
				$('#alerticon').addClass("ion-ios-checkmark tx-success");
				break;
				case 'successAddPresenceConsult':
				$('#alertmessage').text("Berhasil menambahkan Presensi Mahasiswa Kelas Konsultasi");
				$('#alerttitle').addClass("tx-success");
				$('#alerttype').addClass("alert-success");
				$('#alerticon').addClass("fa fa-check-circle");
				break;
			case 'successDeletePresenceConsult':
				$('#alerttitle').text("Data berhasil dihapus!");
				$('#alerttitle').addClass("tx-success");
				$('#alerttype').addClass("alert-success");
				$('#alerticon').addClass("ion-ios-checkmark tx-success");
				break;
			case 'successUpdatePresenceConsult':
				$('#alerttitle').text("Perubahan berhasil");
				$('#alerttitle').addClass("tx-success");
				$('#alertmessage').text("Perubahan Data Presensi berhasil");
				$('#alerttype').addClass("alert-success");
				$('#alerticon').addClass("ion-ios-checkmark tx-success");
				break;
		}
		<?php $this->session->set_userdata('typeNotif', ''); ?>
	});
</script>
