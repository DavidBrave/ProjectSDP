--ADMIN--
INSERT INTO `Admin` (`Admin_ID`, `Admin_Nama`, `Admin_Pass`) VALUES
('ADM1', 'Admin', 'Admin'),
('ADM2', 'David', 'David24'),
('ADM3', 'Andy', 'Andy'),
('ADM4', 'Marco', 'Marco');

--DOSEN--
-- Dosen ID = NIP = TahunLahir + TahunDiangkat + Kelamin + 3 Digit Counter
-- 1 = Pria, 2 = Wanita
INSERT INTO `Dosen` (`Dosen_ID`, `Dosen_Nama`, `Dosen_User`, `Dosen_Pass`, `Dosen_Jabatan`) VALUES
('198020051001', 'Ali Paryono', 'aliparyono1', 'Semangka312', 'Dosen'),
('198020051002', 'Devon Harijadi', 'devonharijadi1', 'Devonhar1982', 'Dosen Wali'),
('198120031001', 'Rio Skuravijh', 'rios1', 'skuy123', 'Dosen'),
('198120032001', 'Kelly Winata', 'kelly1', 'winata2', 'Dosen Wali'),
('198220072001', 'Jeannice Velae', 'jeannicevelae1', 'Catbury11', 'Dosen'),
('198220071001', 'Dennis Dacosta', 'dennisdacosta1', 'D4c0sta', 'Dosen Wali'),
('198320062001', 'Vina Erland', 'vina123', 'aniv123', 'Dosen'),
('198320091001', 'Suryana Mariono', 'taiyou4', 'inipw', 'Dosen Wali'),
('198420141001', 'Guntoro Adiwarman', 'thunder123', 'warman123', 'Dosen'),
('198520102001', 'Dwi Handayani Saputro', 'dwihandayani1', '@Handayani96', 'Dosen Wali'),
('198520101001', 'Andre Susanto', 'andresusanto', 'Qwertyu25', 'Rektor'),
('198720131001', 'Dwi Handayani', 'dwihandayani2', 'TheBeatlles30', 'Wakil Rektor'),
('198920132001', 'Novika Sujono', 'novikasujono1', 'Pecellele123', 'Dosen');


--PERIODE--
-- Periode = TahunMulai_TahunSelesai_Gasal/Genap_Pendek/Normal
-- 1 = Gasal, 2 = Genap | Normal = 1, 2 = Pendek
INSERT INTO `Periode` (`Periode_ID`, `Periode_Nama`) VALUES
('2015201611', 'Tahun Ajaran 2015/2016 Semester Gasal'),
('2015201621', 'Tahun Ajaran 2015/2016 Semester Genap'),
('2016201711', 'Tahun Ajaran 2016/2017 Semester Gasal'),
('2016201721', 'Tahun Ajaran 2016/2017 Semester Genap'),
('2017201811', 'Tahun Ajaran 2017/2018 Semester Gasal'),
('2017201821', 'Tahun Ajaran 2017/2018 Semester Genap'),
('2018201911', 'Tahun Ajaran 2018/2019 Semester Gasal'),
('2018201921', 'Tahun Ajaran 2018/2019 Semester Genap'),
('2019202011', 'Tahun Ajaran 2019/2020 Semester Gasal'),
('2019202021', 'Tahun Ajaran 2019/2020 Semester Genap'),
('2020202111', 'Tahun Ajaran 2020/2021 Semester Gasal'),
('2020202121', 'Tahun Ajaran 2020/2021 Semester Genap'),
('2021202211', 'Tahun Ajaran 2021/2022 Semester Gasal'),
('2021202221', 'Tahun Ajaran 2021/2022 Semester Genap'),
('2022202311', 'Tahun Ajaran 2022/2023 Semester Gasal'),
('2022202321', 'Tahun Ajaran 2022/2023 Semester Genap');


--KURIKULUM--
-- Id = "K" + TahunDibuat + 1 Digit Counter
INSERT INTO `Kurikulum` (`Kurikulum_ID`, `Kurikulum_Nama`) VALUES
('K20041', 'Kurikulum Berbasis Kompetensi'),
('K20061', 'Kurikulum Tingkat Satuan Pendidikan'),
('K20131', 'Kurikulum 2013'),
('K20132', 'Kurikulum 2013 Revisi');


--JURUSAN--
-- Id = "J" + 1 Digit Counter Tingkat Jurusan + 2 Digit Counter Jurusan
-- 1 = D1, 2 = D2, 3 = D3, 4 = D4, 5 = S1, 6 = S2, 7 = S3
INSERT INTO `Jurusan` (`Jurusan_ID`, `Jurusan_Nama`) VALUES
('J301', 'Sistem Informasi'),
('J501', 'Teknik Informatika'),
('J502', 'Desain Komunkiasi Visual'),
('J503', 'Teknik Elektro'),
('J504', 'Sistem Informasi Bisnis'),
('J505', 'Desain Produk');


--MAJOR--
-- Id = "M" + 3 Digit Id Jurusan + 2 Digit Counter
-- Jurusan Id = induk dari major
INSERT INTO `Major` (`Major_ID`, `Jurusan_ID`, `Major_Nama`) VALUES
('M50101', 'J501', 'Internet Technology'),
('M50102', 'J501', 'Computational Intelligence'),
('M50103', 'J501', 'Software Technology');

--MATKUL--
-- Id = "MK" + 4 Digit Counter
INSERT INTO `Matkul` (`Matkul_ID`, `Matkul_Nama`, `Matkul_Standar`) VALUES
('MK0001', 'Matematika 1', 50.0),
('MK0002', 'Matematika 2', 50.0),
('MK0003', 'Algoritma dan Pemrograman 1', 55.0),
('MK0004', 'Algoritma dan Pemrograman 2', 55.0),
('MK0005', 'Intro To Programming', 55.0),
('MK0006', 'Struktur Data', 55.0),
('MK0007', 'Struktur Data Lanjut', 55.0),
('MK0008', 'Program Komputer Aplikasi', 60.0),
('MK0009', 'Internet dan World Wide Web', 55.0),
('MK0010', 'Pengantar Teknologi Informasi', 55.0),
('MK0011', 'Basis Data', 55.0),
('MK0012', 'Jaringan Komputer', 50.0),
('MK0013', 'Pemrograman Berorientasi Objek', 50.0),
('MK0014', 'Analisa dan Desai Sistem', 55.0),
('MK0015', 'Pemrograman Visual', 60.0),
('MK0016', 'Sistem Digital', 50.0),
('MK0017', 'Statistika Terapan', 50.0),
('MK0018', 'Teori Graf', 55.0),
('MK0019', 'Analisa Desain Berorientasi Objek', 55.0),
('MK0020', 'Grafika Komputer', 55.0),
('MK0021', 'Interaksi Manusia dan Komputer', 55.0),
('MK0022', 'Pemrograman Client Server', 60.0),
('MK0023', 'Pemrograman Web', 55.0),
('MK0024', 'Framework Pemrograman Web', 55.0),
('MK0025', 'Kecerdasan Buatan', 50.0),
('MK0026', 'Mobile Device Programming', 60.0),
('MK0027', 'Organisasi Komputer', 55.0),
('MK0028', 'Rekayasa Perangkat Lunak', 50.0),
('MK0029', 'Software Develpoment Project', 55.0),
('MK0030', 'Embedded Systems', 55.0),
('MK0031', 'Kapita Selekta', 50.0),
('MK0032', 'Service Oriented Architecture', 50.0),
('MK0033', 'Soft Computing', 50.0),
('MK0034', 'Kerja Praktek', 60.0),
('MK0035', 'Data Mining', 55.0),
('MK0036', 'Artificial Intelligence for Games', 55.0),
('MK0037', 'Big Data Processing', 60.0),
('MK0038', 'Biomedical Informatics', 60.0),
('MK0039', 'Computer Vision', 55.0),
('MK0040', 'Evolutionary Programming', 60.0),
('MK0041', 'Deep Learning & Advanced Machine Learning', 50.0),
('MK0042', 'Natural Language Understanding', 50.0),
('MK0043', 'Natural User Interface', 55.0),
('MK0044', 'Sistem Operasi', 60.0),
('MK0045', 'Teknik Kompilasi', 50.0),
('MK0046', 'Web Mining', 55.0),
('MK0047', 'Cloud Computing', 60.0),
('MK0048', 'Distributed Database', 60.0),
('MK0049', 'Internet Server Administration', 50.0),
('MK0050', 'Internetworking', 55.0),
('MK0051', 'Ios Mobile Programming', 50.0),
('MK0052', 'Multimedia', 60.0),
('MK0053', 'Network Programming', 55.0),
('MK0054', 'Network Security', 55.0),
('MK0055', 'Accounting Information System', 60.0),
('MK0056', 'Design Patterns', 55.0),
('MK0057', 'E-comm Application', 60.0),
('MK0058', 'Enterprise Java', 50.0),
('MK0059', 'Software Project Management', 60.0);

-- NRP = 3 Digit Tahun Masuk + 3 Digit Jurusan + 4 Digit Counter
-- Masuk Juli 2019, s1 Infor, 5421 = 2195010001
INSERT INTO `Mahasiswa` (`Mahasiswa_ID`,`Dosen_Wali_ID`,`DosenPembimbing_ID`,`Mahasiswa_Nama`,`Mahasiswa_JK`,`Mahasiswa_Alamat`,`Mahasiswa_Tgl`,`Mahasiswa_Agama`,`Mahasiswa_Email`,`Mahasiswa_NoTelp`,`Mahasiswa_Pass`) VALUES
('2143010001','198220071001','198920132001','Sun Jing Woo','M','Jl Bukit Darmo 12, Jawa Timur',TO_DATE('16/09/1998','DD/MM/YYYY'),'Hindu','iron@gmail.com','082340102001','ajin'),
('2143010001','198220071001','198920132001','Ichigaya Hajime','M','Psr Tanah Abang Fl C/I 30 Lt 1, Dki Jakarta',TO_DATE('18/10/1998','DD/MM/YYYY'),'Islam','hjme@gmail.com','082340102002','korosu'),
('2145010001','198220071001','198920132001','Subaru Erina','F','Jl Tebet Dlm VI 40, Dki Jakarta',TO_DATE('17/01/1998','DD/MM/YYYY'),'Kong Hu Cu','gogogo@gmail.com','082340102003','gohan'),
('2145010002','198220071001','198020051001','Akazaki Enjirou','M','Jl Kupang Baru 1 No 95, Jawa Timur',TO_DATE('03/01/1998','DD/MM/YYYY'),'Kristen','enjirou0004@gmail.com','082340102004','einjirou'),
('2145010003','198220071001','198020051001','Kawazaki Yamada','F','Jl Adinegoro 2, Sumatera Utara',TO_DATE('03/09/1998','DD/MM/YYYY'),'Katolik','ymd2da@gmail.com','082340102005','yamayama'),

('2153010001','198220071001','198020051001','Maeno Ema','F','Jl Kapuas 1, Dki Jakarta',TO_DATE('06/12/1997','DD/MM/YYYY'),'Hindu','ema@gmail.com','082340012001','ema222'),
('2153010001','198220071001','198120031001','Inagaki Kurumi','F','Psr Tanah Abang Bl C/I 38 Lt 2, Dki Jakarta',TO_DATE('18/11/1997','DD/MM/YYYY'),'Katolik','inagakikurumi@gmail.com','082340012002','inarichan'),
('2155010001','198220071001','198120031001','Nagasawa Marina','F','Jl Tebet Dlm II 40, Dki Jakarta',TO_DATE('13/11/1997','DD/MM/YYYY'),'Kong Hu Cu','marinanagasawa@gmail.com','082340012003','belzebub'),
('2155010002','198220071001','198120031001','Lisa','M','Jl Setiabudi Simpang Psr 13 10 A, Sumatera Utara',TO_DATE('02/01/1997','DD/MM/YYYY'),'Kristen','lisalisa@gmail.com','082340012004','genuine123'),
('2155010003','198220071001','198120032001','Yamazaki Kento','F','Jl Adinegoro 2, Sumatera Utara',TO_DATE('03/12/1997','DD/MM/YYYY'),'Katolik','kento@gmail.com','082340012005','caramel11'),
('2155010004','198120032001','198120032001','Takahashi Rie','M','Jl Jateul Gg Tegalega 32 A/20 C, Jawa Barat',TO_DATE('21/12/1997','DD/MM/YYYY'),'Buddha','explosion@gmail.com','082340012006','yoakenoinu'),
('2155010005','198120032001','198120032001','Matsuoka Yoshitsugu','F','Jl Kb Kawung 44 B, Jawa Barat',TO_DATE('13/07/1997','DD/MM/YYYY'),'Hindu','kirito@gmail.com','082340012007','boris111'),
('2155010006','198120032001','198220072001','Kousaka Kirino','M','Kompl Griyo Kebraon Utama Fl DF 7, Jawa Timur',TO_DATE('12/12/1997','DD/MM/YYYY'),'Katolik','tsuntsun@gmail.com','082340012008','stagiare23'),
('2155020001','198120032001','198220072001','Orihime Hime','M','Kompl Tmn Permata Indah II Cl N/37, Dki Jakarta',TO_DATE('25/12/1997','DD/MM/YYYY'),'Kong Hu Cu','himehime@gmail.com','082340012009','latom'),
('2155020002','198120032001','198220072001','Akasaka Yoru','M','Jl Cipete Raya 16 B4 A/18, Dki Jakarta',TO_DATE('21/01/1997','DD/MM/YYYY'),'Kristen','bangohan@gmail.com','087890012001','honooo'),

('2163010001','198120032001','198520101001','Shirasaki Ayase','F','Jl Dorang 1, Jawa Timur',TO_DATE('26/04/1998','DD/MM/YYYY'),'Katolik','shirasaki@gmail.com','082340003001','shiro123'),
('2163010001','198120032001','198520101001','Yamato Kudo','F','Jl Dorang 2, Jawa Timur',TO_DATE('28/10/1998','DD/MM/YYYY'),'Islam','kudo1@gmail.com','082340003002','yama123'),
('2165010001','198120032001','198520101001','Tanaka Keiko','F','Jl Dorang 3, Jawa Timur',TO_DATE('27/11/1998','DD/MM/YYYY'),'Kong Hu Cu','keiko23@gmail.com','082340003003','tana123'),
('2165010002','198120032001','198720131001','Eru','M','Jl Mujaer 1, Jawa Timur',TO_DATE('09/02/1998','DD/MM/YYYY'),'Kristen','eru01@gmail.com','082340003004','eru123'),
('2165010003','198120032001','198720131001','Sudou Ikagawa','F','Jl Mujaer 2, Jawa Timur',TO_DATE('23/07/1998','DD/MM/YYYY'),'Katolik','ikagawa2@gmail.com','082340003005','sudou123'),
('2165010004','198020051002','198720131001','Kuro Neko','M','Jl Mujaer 3, Jawa Timur',TO_DATE('21/04/1998','DD/MM/YYYY'),'Buddha','kuro@gmail.com','082340003006','kuro123'),
('2165010005','198020051002','198920132001','Yamada Kotarou','F','Jl Mujaer 4, Jawa Timur',TO_DATE('28/07/1998','DD/MM/YYYY'),'Hindu','yamada22@gmail.com','082340003007','yamada123'),
('2165010006','198020051002','198920132001','Yamada Eriri','M','Jl Mujaer 5, Jawa Timur',TO_DATE('27/12/1998','DD/MM/YYYY'),'Islam','eririri@gmail.com','082340003008','eriri123'),
('2165020001','198020051002','198920132001','Takeguchi Rina','M','Kompl Tmn Permata Indah II Bl N/38, Dki Jakarta',TO_DATE('09/02/1998','DD/MM/YYYY'),'Kong Hu Cu','guchichan@gmail.com','082340003009','take123'),
('2165020002','198020051002','198020051001','Watanabe Ken','M','Jl Cipete Raya 16 Bl B/18, Dki Jakarta',TO_DATE('11/11/1998','DD/MM/YYYY'),'Kristen','ken2@gmail.com','087890003001','watanabe123'),
('2165030001','198020051002','198020051001','Kanata Aria','F','Jl Jend Gatot Subroto 527, Jawa Barat',TO_DATE('27/03/1998','DD/MM/YYYY'),'Katolik','ariaria@gmail.com','087890003002','kanata123'),
('2165030002','198020051002','198020051001','Sorachi Hideaki','F','Jl Tujuh Belas Agustus II/29, Jawa Barat',TO_DATE('29/06/1998','DD/MM/YYYY'),'Buddha','gintama@gmail.com','087890003003','sorachi123'),
('2165050001','198020051002','198020051002','Matsumoto Kurazawa','F','Jl Utan Kayu Raya 80 A, Jakarta',TO_DATE('26/08/1998','DD/MM/YYYY'),'Hindu','sawasawa@gmail.com','087890003004','matsumoto123'),
('2165050002','198020051002','198020051002','John','F','Jl Metro Pd Indah Pondok Indah Mall, Dki Jakarta',TO_DATE('11/11/1998','DD/MM/YYYY'),'Islam','johnnn@gmail.com','087890003005','john123'),
('2165050003','198020051002','198020051002','Stella Rium','F','Jl Sultan Agung 9, Jawa Tengah',TO_DATE('02/04/1998','DD/MM/YYYY'),'Kong Hu Cu','kano@gmail.com','087890003006','stella123'),

('2173010001','198520102001','198520101001','Noah Jung','F','Jl H Domang 31, Dki Jakarta',TO_DATE('06/09/1997','DD/MM/YYYY'),'Hindu','noahjung@gmail.com','082340002001','221116775'),
('2173010002','198520102001','198520101001','Jesse Pandebayang','F','Psr Tanah Abang Bl C/I 30 Lt 1, Dki Jakarta',TO_DATE('18/10/1999','DD/MM/YYYY'),'Islam','jessepandebayang@gmail.com','082340002002','221116776'),
('2175010001','198520102001','198520101001','David Sinuraya','F','Jl Tebet Dlm III 40, Dki Jakarta',TO_DATE('17/11/1999','DD/MM/YYYY'),'Kong Hu Cu','davidsinuraya@gmail.com','082340002003','221116777'),
('2175010002','198520102001','198720131001','Darma','M','Jl Setiabudi Simpang Psr 3 10 A, Sumatera Utara',TO_DATE('09/01/1999','DD/MM/YYYY'),'Kristen','darma@gmail.com','082340002004','221116778'),
('2175010003','198520102001','198720131001','Sriwidadi','F','Jl Adinegoro 1, Sumatera Utara',TO_DATE('03/07/1999','DD/MM/YYYY'),'Katolik','sriwidadi@gmail.com','082340002005','221116779'),
('2175010004','198020051002','198720131001','Citra Inge Sugiarto','M','Jl Jateul Gg Tegalega 52 A/20 C, Jawa Barat',TO_DATE('21/02/1999','DD/MM/YYYY'),'Buddha','citraingesugiarto@gmail.com','082340002006','221116780'),
('2175010005','198020051002','198920132001','Cahaya Widya Rachman','F','Jl Kb Kawung 74 B, Jawa Barat',TO_DATE('18/07/1999','DD/MM/YYYY'),'Hindu','cahayawidyarachman@gmail.com','082340002007','221116781'),
('2175010006','198020051002','198920132001','Onggo Yanyu','M','Kompl Griyo Kebraon Utama Bl DF 7, Jawa Timur',TO_DATE('07/12/1999','DD/MM/YYYY'),'Islam','onggoyanyu@gmail.com','082340002008','221116782'),
('2175020001','198020051002','198920132001','Wongsojoyo Ushi','M','Kompl Tmn Permata Indah II Bl N/37, Dki Jakarta',TO_DATE('09/12/1999','DD/MM/YYYY'),'Kong Hu Cu','wongsojoyoushi@gmail.com','082340002009','221116783'),
('2175020002','198020051002','198020051001','Babette Silooy','M','Jl Cipete Raya 16 Bl A/18, Dki Jakarta',TO_DATE('11/01/1999','DD/MM/YYYY'),'Kristen','babettesilooy@gmail.com','087890002001','221116784'),
('2175030001','198020051002','198020051001','Drusilla Malau','F','Jl Jend Gatot Subroto 517, Jawa Barat',TO_DATE('21/03/1999','DD/MM/YYYY'),'Katolik','drusillamalau@gmail.com','087890002002','221116785'),
('2175030002','198020051002','198020051001','Elisha Hutabangun','F','Jl Tujuh Belas Agustus II/19, Jawa Barat',TO_DATE('20/06/1999','DD/MM/YYYY'),'Buddha','elishahutabangun@gmail.com','087890002003','221116786'),
('2175050001','198020051002','198020051002','Terah Sinupayung','F','Jl Utan Kayu Raya 70 A, Jakarta',TO_DATE('16/08/1999','DD/MM/YYYY'),'Hindu','terahsinupayung@gmail.com','087890002004','221116787'),
('2175050002','198020051002','198020051002','Ratu','F','Jl Metro Pd Indah Pondok Indah Mall, Dki Jakarta',TO_DATE('11/11/1999','DD/MM/YYYY'),'Islam','ratu@gmail.com','087890002005','221116788'),
('2175050003','198020051002','198020051002','Utari','F','Jl Sultan Agung 3, Jawa Tengah',TO_DATE('02/11/1999','DD/MM/YYYY'),'Kong Hu Cu','utari@gmail.com','087890002006','221116789'),

('2183010001','198020051002','198020051001','Djaja Raja Kusnadi','F','Jl Pacar 15 A, Jawa Barat',TO_DATE('21/02/2000','DD/MM/YYYY'),'Kristen','djajarajakusnadi@gmail.com','081230001001','218116730'),
('2183010002','198020051002','198020051001','Hadi Slamet Susanto','F','Jl Legian Kuta, Bali',TO_DATE('18/07/2000','DD/MM/YYYY'),'Katolik','hadislametsusanto@gmail.com','081230001002','218116731'),
('2185010001','198020051002','198020051001','Limijanto Yi','M','Jl Mangga 19, Dki Jakarta',TO_DATE('07/12/2000','DD/MM/YYYY'),'Buddha','limijanto2i@gmail.com','2025550101','081230001003'),
('2185010002','198020051002','198020051002','Tejarukmana Shi','F','Jl Hayam Wuruk 1 R/V, Dki Jakarta',TO_DATE('09/12/2000','DD/MM/YYYY'),'Hindu','tejarukmanashi@gmail.com','081230001004','218116733'),
('2185010003','198020051002','198020051002','Lard Pattinasarani','F','Jl Raden Saleh 51 Pav, Dki Jakarta',TO_DATE('11/01/2000','DD/MM/YYYY'),'Islam','lardpattinasarani@gmail.com','081230001005','218116734'),
('2185010004','198020051002','198020051002','Abihu Ritonga','F','Jl Letjen South Parman Kav 21, Dki Jakarta',TO_DATE('21/03/2000','DD/MM/YYYY'),'Kong Hu Cu','abihuritonga@gmail.com','081230001006','218116735'),
('2185020001','198020051002','198120031001','Timothy Sabab','M','Jl Darmo Permai Timur Vi/ 2, Propinsi Jawa Timur',TO_DATE('20/06/2000','DD/MM/YYYY'),'Kristen','timothysabab@gmail.com','081230001007','218116736'),
('2185020002','198020051002','198120031001','Uzziah Batubara','F','Jl Dr Sutomo 29 BC, Sumatera Utara',TO_DATE('16/08/2000','DD/MM/YYYY'),'Katolik','uzziahbatubara@gmail.com','081230001008','218116737'),
('2185030001','198020051002','198120031001','Kuwat','M','Jl Pejaten Brt II 7 Psr Minggu Pejaten Barat Jakarta Slt, Jakarta',TO_DATE('11/11/2000','DD/MM/YYYY'),'Buddha','kuwat@gmail.com','081230001009','218116738'),
('2185030002','198020051002','198120032001','Suharto','F','Jl Mangga Besar V 277 B, Dki Jakarta',TO_DATE('02/11/2000','DD/MM/YYYY'),'Hindu','Suharto@gmail.com','082340001001','218116739'),
('2185030003','198120032001','198120032001','Yanti Liana Hermawan','M','Jl Bahtera Bl Z-1/18 Kapuk Muara, Dki Jakarta',TO_DATE('19/07/2000','DD/MM/YYYY'),'Islam','yantilianahermawan@gmail.com','082340001002','218116740'),
('2185040001','198120032001','198120032001','Eka Siska Sudjarwadi','F','Jl Raya Boulevard Tmr Raya Bl A/1, Dki Jakarta',TO_DATE('15/08/2000','DD/MM/YYYY'),'Kong Hu Cu','ekasiskasudjarwadi@gmail.com','082340001003','218116741'),
('2185040002','198120032001','198220072001','Fandi Changying','M','Jl Kom L Yos Sudarso Kav 89, Dki Jakarta',TO_DATE('05/11/2000','DD/MM/YYYY'),'Kristen','fandichangying@gmail.com','082340001004','218116742'),
('2185050001','198120032001','198220072001','Setiawan Yuèhai','F','Jl Asia Afrika - Pintu IX STC Senayan, Dki Jakarta',TO_DATE('09/12/2000','DD/MM/YYYY'),'Katolik','setiawanyuehai@gmail.com','082340001005','218116743'),
('2185050002','198120032001','198220072001','Aicha Angwarmasse','F','Jl Mampang Prapatan 15 RT 14/04, Dki Jakarta',TO_DATE('11/06/2000','DD/MM/YYYY'),'Buddha','aichaangwarmasse@gmail.com','082340001006','218116744'),

('2193010001','198120032001','198220071001','Chloe Meha','F','Jl Gedongan Palem Wulung 23, Jawa Tengah',TO_DATE('28/06/2001','DD/MM/YYYY'),'Hindu','chlomeha@gmail.com','082340001007','219116745'),
('2193010002','198120032001','198220071001','Phoebe Gersang','M','Jl Cipagalo 214, Jawa Barat',TO_DATE('16/11/2001','DD/MM/YYYY'),'Islam','phoebegersang@gmail.com','082340001008','219116746'),
('2193010003','198120032001','198220071001','Tamar Sidebang','F','Kompl Kopo Mas Regency Bl 18 C, Jawa Barat',TO_DATE('29/12/2001','DD/MM/YYYY'),'Kong Hu Cu','tamarsidebang@gmail.com','082340001009','219116747'),
('2195010001','198120032001','198320062001','Eko','M','Jl KH Zainul Arifin Kompl Ketapang Indah Bl B-1/6, Dki Jakarta',TO_DATE('12/06/2001','DD/MM/YYYY'),'Kristen','eko@gmail.com','087890001001','219116748'),
('2195010002','198120032001','198320062001','Surtinem','M','Jl Kramat Sawah Baru E-328, Dki Jakarta',TO_DATE('18/08/2001','DD/MM/YYYY'),'Katolik','surtinem@gmail.com','087890001002','219116749'),
('2195010003','198220072001','198320062001','Surya Setiawan Setiabudi','F','Jl Kedung Cowek 120, Jawa Timur',TO_DATE('06/09/2001','DD/MM/YYYY'),'Buddha','suryasetiawansetiabudi@gmail.com','087890001003','219116750'),
('2195010004','198220072001','198320091001','Harta Sugiarto Yuwono','M','Jl Majapahit 63, Jawa Tengah',TO_DATE('18/10/2001','DD/MM/YYYY'),'Hindu','hartasugiartoyuwono@gmail.com','087890001004','219116751'),
('2195010005','198220072001','198320091001','Solikin Jian','M','Jl Balongpanggang 3 62283',TO_DATE('17/11/2001','DD/MM/YYYY'),'Islam','solikinjian@gmail.com','087890001005','219116752'),
('2195020001','198220072001','198320091001','Tantama Shàoqiáng','F','Jl Kutisari Slt 105, Jawa Timur',TO_DATE('09/01/2001','DD/MM/YYYY'),'Kong Hu Cu','tantamashaoqiang@gmail.com','087890001006','219116753'),
('2195020002','198220072001','198420141001','Ilan Tahapary','M','Jl Karang Anyar 55 Bl B/17 Karang Anyar, Dki Jakarta',TO_DATE('03/07/2001','DD/MM/YYYY'),'Kristen','ilantahapary@gmail.com','087890001007','219116754'),
('2195030001','198220072001','198420141001','Silas Mano','M','Jl Toko Tiga 24, Dki Jakarta',TO_DATE('21/02/2001','DD/MM/YYYY'),'Katolik','silasmano@gmail.com','087890001008','219116755'),
('2195040001','198220072001','198420141001','Zebedee Solin','F','Kompl Cemara Boulevard Bl A-1/30, Sumatera Utara',TO_DATE('18/07/2001','DD/MM/YYYY'),'Buddha','zebedeesolin@gmail.com','087890001009','219116756'),
('2195040002','198220072001','198520102001','Phineas Limbong','M','Jl Tmn Ade Irma Suryani 3 A, Jawa Tengah',TO_DATE('07/12/2001','DD/MM/YYYY'),'Hindu','phineaslimbong@gmail.com','085670001001','219116757'),
('2195040003','198220072001','198520102001','Raharjo','M','Psr Tanah Abang Bl A Los PKS/5 Lt 1, Dki Jakarta',TO_DATE('09/12/2001','DD/MM/YYYY'),'Islam','raharjo@gmail.com','085670001002','219116758'),
('2195050001','198220072001','198520102001','Purwodarminto','F','Jl Puri Kencana Bl M-8/1 H Perk Puri Niaga III, Dki',TO_DATE('11/01/2001','DD/MM/YYYY'),'Kong Hu Cu','purwodarminto@gmail.com','085670001003','219116759'),

('2203010001','198320091001','','Tri Batari Tedjo','M','l Puncak Permai Utr 47, Jawa Timur',TO_DATE('21/03/2002','DD/MM/YYYY'),'Kristen','tribataritedjo@gmail.com','085670001004','220116760'),
('2205010001','198320091001','','Sari Batari Tedja','M','Jl Kaliwaru I 27 G, Jawa Timur',TO_DATE('20/06/2002','DD/MM/YYYY'),'Katolik','saribataritedja@gmail.com','085670001005','220116761'),
('2205010002','198320091001','','Soeganda Meiying','F','Jl SH Wardoyo 15 RT 21, Sumatera Selatan',TO_DATE('16/08/2002','DD/MM/YYYY'),'Buddha','soegandameiying@gmail.com','085670001006','220116762'),
('2205010003','198320091001','','Lukas Nuo','M','Jl P Jayakarta 115 Bl C 4, Dki Jakarta',TO_DATE('11/11/2002','DD/MM/YYYY'),'Hindu','lukasnuo@gmail.com','085670001007','220116763'),
('2205010004','198320091001','','Gaelle Hehanusa','M','Jl Jend Basuki Rachmad 16-18, Jawa Timur',TO_DATE('02/11/2002','DD/MM/YYYY'),'Islam','gaellehehanusa@gmail.com','085670001008','220116764'),
('2205010005','198320091001','','Grace Simargolang','M','Jl Penjernihan I 12 RT 006/06, Dki Jakarta',TO_DATE('19/07/2002','DD/MM/YYYY'),'Kong Hu Cu','gracesimargolang@gmail.com','085670001009','220116765'),
('2205020001','198320091001','','Neriah Rumahorbo','F','JL By Pass Prof Dr IB Mantra 98, Kesiman Kertalangu',TO_DATE('15/08/2002','DD/MM/YYYY'),'Kristen','neriahrumahorbo@gmail.com','081230002001','220116766'),
('2205020002','198320091001','','Esther Sidari','M','Jl Pintu Besar Slt 34, Dki Jakarta',TO_DATE('05/11/2002','DD/MM/YYYY'),'Katolik','esthersidari@gmail.com','081230002002','220116767'),
('2205020003','198320091001','','Wangi','F','Jl Rorotan 9/7, Dki Jakarta',TO_DATE('09/12/2002','DD/MM/YYYY'),'Buddha','wangi@gmail.com','081230002003','220116768'),
('2205030001','198320091001','','Surtinem','F','Jl Darmo Indah Tmr Bl K/17, Jawa Timur',TO_DATE('11/06/2002','DD/MM/YYYY'),'Hindu','surtinem@gmail.com','081230002004','220116769'),
('2205030002','198520102001','','Suparman Buana Halim','F','Jl Biru Laut X 21, Dki Jakarta',TO_DATE('28/06/2002','DD/MM/YYYY'),'Islam','suparmanbuanahalim@gmail.com','081230002005','220116770'),
('2205030003','198520102001','','Doddy Raja Kusumo','F','Jl Banjardowo RT 003/II, Jawa Tengah',TO_DATE('16/11/2002','DD/MM/YYYY'),'Kong Hu Cu','doddyrajakusumo@gmail.com','081230002006','220116771'),
('2205030004','198520102001','','Cokro Yingjie','F','Jl Kereta Api Gg Pertama 61, Sumatera Utara',TO_DATE('29/12/2002','DD/MM/YYYY'),'Kristen','cokroyingjie@gmail.com','081230002007','220116772'),
('2205030005','198520102001','','Wuisan Changpu','F','Jl Arteri Mangga Dua Raya Mal Mangga Dua Bl B/89, Dki Jakarta',TO_DATE('12/06/2002','DD/MM/YYYY'),'Katolik','wuisanchangpu@gmail.com','081230002008','220116773'),
('2205040001','198520102001','','Yorit Pooroe','F','Jl Jatiwaringin Raya 9, Dki Jakarta',TO_DATE('18/08/2002','DD/MM/YYYY'),'Buddha','yoritpooroe@gmail.com','081230002009','220116774');