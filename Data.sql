

INSERT INTO `Admin` (`Admin_ID`, `Admin_Nama`, `Admin_Pass`) VALUES
('Adm1', 'Admin', 'Admin'),
('Adm2', 'David', 'David24'),
('Adm3', 'Andy', 'Andy'),
('Adm4', 'Marco', 'Marco');


-- Dosen ID = NIP = TahunLahir + BulanLahir + TanggalLahir + TahunDiangkat + BulanDiangkat + Kelamin + 3 Digit Counter
-- 1 = Pria, 2 = Wanita | David = 200001012020092001
INSERT INTO `Dosen` (`Dosen_ID`, `Dosen_Nama`, `Dosen_User`, `Dosen_Pass`, `Dosen_Jabatan`) VALUES
('1', 'Dosen Testing', 'Dosen', 'Dosen', 'Dosen'),
('198212032005081003', 'Ali Paryono', 'aliparyono1', 'Semangka312', 'Dosen'),
('198010132002081010', 'Devon Harijadi', 'devonharijadi1', 'Devonhar1982', 'Dosen Wali'),
('199501012019102112', 'Jeannice Velae', 'jeannicevelae1', 'Catbury11', 'Dosen'),
('199004302010081072', 'Dennis Dacosta', 'dennisdacosta1', 'D4c0sta', 'Dosen'),
('199631012018092010', 'Dwi Handayani Saputro', 'dwihandayani1', '@Handayani96', 'Dosen Wali'),
('198911252006081022', 'Andre Susanto', 'andresusanto', 'Qwertyu25', 'Rektor'),
('199106302009072054', 'Dwi Handayani', 'dwihandayani2', 'TheBeatlles30', 'Wakil Rektor'),
('198721102000081001', 'Novika Sujono', 'novikasujono1', 'Pecellele123', 'Dosen Wali');


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


-- Id = "Klm" + TahunDibuat + 1 Digit Counter
INSERT INTO `Kurikulum` (`Kurikulum_ID`, `Kurikulum_Nama`) VALUES
('Klm20041', 'Kurikulum Berbasis Kompetensi'),
('Klm20061', 'Kurikulum Tingkat Satuan Pendidikan'),
('Klm20131', 'Kurikulum 2013'),
('Klm20132', 'Kurikulum 2013 Revisi');


-- Id = "Jrs" + 1 Digit Counter Tingkat Jurusan + 2 Digit Counter Jurusan
-- 1 = D1, 2 = D2, 3 = D3, 4 = D4, 5 = S1, 6 = S2, 7 = S3
INSERT INTO `Jurusan` (`Jurusan_ID`, `Jurusan_Nama`) VALUES
('Jrs301', 'Sistem Informasi'),
('Jrs501', 'Teknik Informatika'),
('Jrs502', 'Desain Komunkiasi Visual'),
('Jrs503', 'Teknik Elektro'),
('Jrs504', 'Sistem Informasi Bisnis'),
('Jrs505', 'Desain Produk');


-- Id = "Mjr" + 3 Digit Id Jurusan + 2 Digit Counter
-- Jurusan Id = induk dari major
INSERT INTO `Major` (`Major_ID`, `Jurusan_ID`, `Major_Nama`) VALUES
('Mjr50101', 'Jrs501', 'Internet Technology'),
('Mjr50102', 'Jrs501', 'Computational Intelligence'),
('Mjr50103', 'Jrs501', 'Software Technology');


-- Id = "Mtk" + 4 Digit Counter
INSERT INTO `Matkul` (`Matkul_ID`, `Matkul_Nama`, `Matkul_Standar`) VALUES
('Mtk0001', 'Matematika 1', 50.0),
('Mtk0002', 'Matematika 2', 50.0),
('Mtk0003', 'Algoritma dan Pemrograman 1', 55.0),
('Mtk0004', 'Algoritma dan Pemrograman 2', 55.0),
('Mtk0005', 'Intro To Programming', 55.0),
('Mtk0006', 'Struktur Data', 55.0),
('Mtk0007', 'Struktur Data Lanjut', 55.0),
('Mtk0008', 'Program Komputer Aplikasi', 60.0);

-- NRP = Tahun Masuk + Bulan Masuk (07) + 3 Digit Jurusan + 4 Digit Counter
-- Masuk Juli 2019, s1 Infor, 5421 = 19075015421
