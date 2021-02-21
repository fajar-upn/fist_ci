## Website Manajemen Fist Effect

<span style="background-color:#ff686b; padding-left:5px; padding-right:5px; border-radius:5px">Dalam masa pengembangan</span>

Jika dalam melakukan cloning project, disarankan menggunakan nama project `fist_ci`. Jika menggunakan nama lain maka ubah `RewriteBase` yang terdapat dalam `.htaccess` menjadi `/nama_folder_project/`; adapun hasil struktur projectnya:

<pre>
.
├── fist_ci
│   ├── application
│   ├── includes
│   ├── system
│   └── user_guide
└── . . .
</pre>

atau apabila project dimasukkan dalam folder lain maka diubah menjadi `/nama_folder/nama_folder_project/`.

<pre>
nama_folder
├── .
│   ├── fist_ci
│   │   ├── application
│   │   ├── includes
│   │   ├── system
│   │   └── user_guide
│   └── . . .
└── . . .    
</pre>