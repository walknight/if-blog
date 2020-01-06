-- Valentina Studio --
-- MySQL dump --
-- ---------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
-- ---------------------------------------------------------


-- CREATE TABLE "if_categories" --------------------------------
CREATE TABLE `if_categories` ( 
	`id` Int( 11 ) AUTO_INCREMENT NOT NULL,
	`name` VarChar( 60 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
	`url_name` VarChar( 200 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
	`description` VarChar( 200 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
	PRIMARY KEY ( `id` ) )
CHARACTER SET = utf8
COLLATE = utf8_general_ci
ENGINE = InnoDB
AUTO_INCREMENT = 6;
-- -------------------------------------------------------------


-- CREATE TABLE "if_comments" ----------------------------------
CREATE TABLE `if_comments` ( 
	`id` Int( 11 ) AUTO_INCREMENT NOT NULL,
	`post_id` Int( 11 ) NULL DEFAULT 0,
	`user_id` Int( 11 ) NULL,
	`author` VarChar( 50 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
	`author_email` VarChar( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
	`author_website` VarChar( 200 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
	`author_ip` VarChar( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`content` Text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
	`date` DateTime NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY ( `id` ) )
CHARACTER SET = utf8
COLLATE = utf8_general_ci
ENGINE = InnoDB
AUTO_INCREMENT = 1;
-- -------------------------------------------------------------


-- CREATE TABLE "if_groups" ------------------------------------
CREATE TABLE `if_groups` ( 
	`id` MediumInt( 8 ) UNSIGNED AUTO_INCREMENT NOT NULL,
	`name` VarChar( 20 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`description` VarChar( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	PRIMARY KEY ( `id` ) )
CHARACTER SET = utf8
COLLATE = utf8_general_ci
ENGINE = InnoDB
AUTO_INCREMENT = 3;
-- -------------------------------------------------------------


-- CREATE TABLE "if_languages" ---------------------------------
CREATE TABLE `if_languages` ( 
	`id` Int( 11 ) AUTO_INCREMENT NOT NULL,
	`language` VarChar( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
	`abbreviation` VarChar( 3 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
	`author` VarChar( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
	`author_website` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`is_default` Enum( '0', '1' ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
	PRIMARY KEY ( `id` ) )
CHARACTER SET = utf8
COLLATE = utf8_general_ci
ENGINE = InnoDB
AUTO_INCREMENT = 3;
-- -------------------------------------------------------------


-- CREATE TABLE "if_links" -------------------------------------
CREATE TABLE `if_links` ( 
	`id` Int( 11 ) AUTO_INCREMENT NOT NULL,
	`name` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
	`url` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
	`target` Enum( 'blank', 'self', 'parent' ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'blank',
	`description` VarChar( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
	`visible` Enum( 'yes', 'no' ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'yes',
	PRIMARY KEY ( `id` ) )
CHARACTER SET = utf8
COLLATE = utf8_general_ci
ENGINE = InnoDB
AUTO_INCREMENT = 3;
-- -------------------------------------------------------------


-- CREATE TABLE "if_login_attempts" ----------------------------
CREATE TABLE `if_login_attempts` ( 
	`id` Int( 11 ) UNSIGNED AUTO_INCREMENT NOT NULL,
	`ip_address` VarChar( 45 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`login` VarChar( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`time` Int( 11 ) UNSIGNED NULL,
	PRIMARY KEY ( `id` ) )
CHARACTER SET = utf8
COLLATE = utf8_general_ci
ENGINE = InnoDB
AUTO_INCREMENT = 1;
-- -------------------------------------------------------------


-- CREATE TABLE "if_navigation" --------------------------------
CREATE TABLE `if_navigation` ( 
	`id` Int( 11 ) AUTO_INCREMENT NOT NULL,
	`title` VarChar( 50 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
	`description` VarChar( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
	`url` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
	`external` Enum( '0', '1' ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0',
	`position` Int( 11 ) NULL DEFAULT 0,
	PRIMARY KEY ( `id` ) )
CHARACTER SET = utf8
COLLATE = utf8_general_ci
ENGINE = InnoDB
AUTO_INCREMENT = 4;
-- -------------------------------------------------------------


-- CREATE TABLE "if_pages" -------------------------------------
CREATE TABLE `if_pages` ( 
	`id` Int( 11 ) AUTO_INCREMENT NOT NULL,
	`title` VarChar( 200 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
	`url_title` VarChar( 200 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
	`author` Int( 11 ) NULL DEFAULT 0,
	`date` DateTime NULL,
	`content` Text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
	`status` Enum( 'active', 'inactive' ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'active',
	`type` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	PRIMARY KEY ( `id` ) )
CHARACTER SET = utf8
COLLATE = utf8_general_ci
ENGINE = InnoDB
AUTO_INCREMENT = 1;
-- -------------------------------------------------------------


-- CREATE TABLE "if_posts" -------------------------------------
CREATE TABLE `if_posts` ( 
	`id` Int( 11 ) AUTO_INCREMENT NOT NULL,
	`author` Int( 11 ) NOT NULL DEFAULT 0,
	`date_posted` DateTime NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`meta_key` Text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`meta_desc` Text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`title` VarChar( 200 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`id_cat` Int( 11 ) NOT NULL DEFAULT 0,
	`content_id` Int( 11 ) NOT NULL DEFAULT 0,
	`url_title` VarChar( 200 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`head_article` Text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`main_article` LongText CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`allow_comments` Enum( '0', '1' ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '1',
	`sticky` Int( 1 ) NOT NULL DEFAULT 0,
	`featured` Int( 1 ) NOT NULL DEFAULT 0,
	`status` Enum( 'draft', 'published' ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'published',
	`hit` Int( 11 ) NOT NULL DEFAULT 0,
	PRIMARY KEY ( `id`, `allow_comments` ) )
CHARACTER SET = utf8
COLLATE = utf8_general_ci
ENGINE = InnoDB
AUTO_INCREMENT = 10;
-- -------------------------------------------------------------


-- CREATE TABLE "if_posts_to_categories" -----------------------
CREATE TABLE `if_posts_to_categories` ( 
	`id` Int( 11 ) AUTO_INCREMENT NOT NULL,
	`post_id` Int( 11 ) NOT NULL,
	`category_id` Int( 11 ) NOT NULL,
	PRIMARY KEY ( `id` ) )
CHARACTER SET = utf8
COLLATE = utf8_general_ci
ENGINE = InnoDB
AUTO_INCREMENT = 2;
-- -------------------------------------------------------------


-- CREATE TABLE "if_settings" ----------------------------------
CREATE TABLE `if_settings` ( 
	`name` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`value` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	PRIMARY KEY ( `name` ) )
CHARACTER SET = utf8
COLLATE = utf8_general_ci
ENGINE = InnoDB;
-- -------------------------------------------------------------


-- CREATE TABLE "if_sidebar" -----------------------------------
CREATE TABLE `if_sidebar` ( 
	`id` Int( 11 ) AUTO_INCREMENT NOT NULL,
	`title` VarChar( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`file` VarChar( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`status` Enum( 'enabled', 'disabled' ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`position` Int( 11 ) NOT NULL,
	PRIMARY KEY ( `id` ) )
CHARACTER SET = utf8
COLLATE = utf8_general_ci
ENGINE = InnoDB
AUTO_INCREMENT = 8;
-- -------------------------------------------------------------


-- CREATE TABLE "if_tags" --------------------------------------
CREATE TABLE `if_tags` ( 
	`id` Int( 11 ) AUTO_INCREMENT NOT NULL,
	`name` VarChar( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	PRIMARY KEY ( `id` ) )
CHARACTER SET = utf8
COLLATE = utf8_general_ci
ENGINE = InnoDB
AUTO_INCREMENT = 3;
-- -------------------------------------------------------------


-- CREATE TABLE "if_tags_to_posts" -----------------------------
CREATE TABLE `if_tags_to_posts` ( 
	`id` Int( 11 ) AUTO_INCREMENT NOT NULL,
	`tag_id` Int( 11 ) NOT NULL,
	`post_id` Int( 11 ) NOT NULL,
	PRIMARY KEY ( `id` ) )
CHARACTER SET = utf8
COLLATE = utf8_general_ci
ENGINE = InnoDB
AUTO_INCREMENT = 3;
-- -------------------------------------------------------------


-- CREATE TABLE "if_templates" ---------------------------------
CREATE TABLE `if_templates` ( 
	`id` Int( 11 ) AUTO_INCREMENT NOT NULL,
	`name` VarChar( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
	`author` VarChar( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
	`path` VarChar( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
	`image` VarChar( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
	`is_default` Enum( '0', '1' ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '1',
	PRIMARY KEY ( `id` ) )
CHARACTER SET = utf8
COLLATE = utf8_general_ci
ENGINE = InnoDB
AUTO_INCREMENT = 3;
-- -------------------------------------------------------------


-- CREATE TABLE "if_users" -------------------------------------
CREATE TABLE `if_users` ( 
	`id` Int( 11 ) UNSIGNED AUTO_INCREMENT NOT NULL,
	`ip_address` VarChar( 45 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`username` VarChar( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
	`password` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`email` VarChar( 254 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`activation_selector` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
	`activation_code` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
	`forgotten_password_selector` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
	`forgotten_password_code` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
	`forgotten_password_time` Int( 11 ) UNSIGNED NULL,
	`remember_selector` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
	`remember_code` VarChar( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
	`created_on` Int( 11 ) UNSIGNED NOT NULL,
	`last_login` Int( 11 ) UNSIGNED NULL,
	`active` TinyInt( 1 ) UNSIGNED NULL,
	`first_name` VarChar( 50 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
	`last_name` VarChar( 50 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
	`company` VarChar( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
	`phone` VarChar( 20 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
	PRIMARY KEY ( `id` ),
	CONSTRAINT `uc_activation_selector` UNIQUE( `activation_selector` ),
	CONSTRAINT `uc_email` UNIQUE( `email` ),
	CONSTRAINT `uc_forgotten_password_selector` UNIQUE( `forgotten_password_selector` ),
	CONSTRAINT `uc_remember_selector` UNIQUE( `remember_selector` ) )
CHARACTER SET = utf8
COLLATE = utf8_general_ci
ENGINE = InnoDB
AUTO_INCREMENT = 2;
-- -------------------------------------------------------------


-- CREATE TABLE "if_users_groups" ------------------------------
CREATE TABLE `if_users_groups` ( 
	`id` Int( 11 ) UNSIGNED AUTO_INCREMENT NOT NULL,
	`user_id` Int( 11 ) UNSIGNED NOT NULL,
	`group_id` MediumInt( 8 ) UNSIGNED NOT NULL,
	PRIMARY KEY ( `id` ),
	CONSTRAINT `uc_if_users_groups` UNIQUE( `user_id`, `group_id` ) )
CHARACTER SET = utf8
COLLATE = utf8_general_ci
ENGINE = InnoDB
AUTO_INCREMENT = 3;
-- -------------------------------------------------------------


-- Dump data of "if_categories" ----------------------------
INSERT INTO `if_categories`(`id`,`name`,`url_name`,`description`) VALUES 
( '1', 'Uncategorized', 'uncategorized', 'Uncategorized' ),
( '2', 'Freebies', 'freebies', 'cat for freebies' ),
( '3', 'Codeigniter', 'codeigniter', 'categories for codeigniter post' ),
( '4', 'Flutter', 'flutter', 'categories for flutter post' ),
( '5', 'Problem Solved', 'problem_solved', 'categories for problem solved post' );
-- ---------------------------------------------------------


-- Dump data of "if_comments" ------------------------------
-- ---------------------------------------------------------


-- Dump data of "if_groups" --------------------------------
INSERT INTO `if_groups`(`id`,`name`,`description`) VALUES 
( '1', 'admin', 'Administrator' ),
( '2', 'members', 'General User' );
-- ---------------------------------------------------------


-- Dump data of "if_languages" -----------------------------
INSERT INTO `if_languages`(`id`,`language`,`abbreviation`,`author`,`author_website`,`is_default`) VALUES 
( '1', 'english', 'en', 'Tomaz Muraus', 'http://www.open-blog.info', '1' ),
( '2', 'slovene', 'sl', 'Tomaz Muraus', 'http://www.open-blog.info', '0' );
-- ---------------------------------------------------------


-- Dump data of "if_links" ---------------------------------
INSERT INTO `if_links`(`id`,`name`,`url`,`target`,`description`,`visible`) VALUES 
( '1', 'Open Blog', 'http://www.open-blog.info', 'blank', 'Open Blog Website', 'yes' ),
( '2', 'CodeIgniter', 'http://www.codeigniter.com', 'blank', 'Codeigniter PHP Framework', 'yes' );
-- ---------------------------------------------------------


-- Dump data of "if_login_attempts" ------------------------
-- ---------------------------------------------------------


-- Dump data of "if_navigation" ----------------------------
INSERT INTO `if_navigation`(`id`,`title`,`description`,`url`,`external`,`position`) VALUES 
( '1', 'Home', 'Index', 'index.php', '0', '1' ),
( '2', 'Archive', 'Archive', 'blog/archive/', '0', '2' ),
( '3', 'Subscribe', 'menu for subscribe', 'home/subscribe', '0', '3' );
-- ---------------------------------------------------------


-- Dump data of "if_pages" ---------------------------------
-- ---------------------------------------------------------


-- Dump data of "if_posts" ---------------------------------
INSERT INTO `if_posts`(`id`,`author`,`date_posted`,`meta_key`,`meta_desc`,`title`,`id_cat`,`content_id`,`url_title`,`head_article`,`main_article`,`allow_comments`,`sticky`,`featured`,`status`,`hit`) VALUES 
( '1', '1', '2011-03-21 00:00:00', '', '', 'Welcome to My Blog', '0', '0', 'welcome-to-my-blog', '<p>Hello Guest :)</p>
<p>Selamat datang di blog i-fuk.com. Blog yang  berisikan beberapa  artikel menarik dan mungkin sedikit kisah tentang  saya (wong namanya  juga web personal :p ) yang mungkin BISA menjadi bahan inspirasi atau  mungkin bisa bikin kalian tambah puyeng.. :p</p>', '<p>Ok guys!! langsung aja deh,  explore my blog, read the post, tinggalkan jejak (comment dikit yah.. :)  ) and enjoy... :)</p>', '1', '1', '0', 'published', '0' ),
( '2', '1', '2012-05-24 00:00:00', 'blog,bla,bla,bla,bla', 'bla bla bla lorem ipsum', 'Etika Terkait Penggunaan Hi-Tech', '2', '5', 'etika-terkait-penggunaan-hi-tech', '<p><strong>Etika Dalam Penggunaan Internet</strong></p>
<p>Sejak awal peradaban, manusia selalu termotivasi memperbaharui teknologi yang ada. Hal ini merupakan perkembangan yang hebat dan terus mengalami kemajuan. Dari semua kemajuan yang signifikan yang dibuat oleh manusia sampai hari ini, mungkin hal yang terpenting adalah perkembangan internet.</p>', '<p>Internet ( Interconection Networking ) merupakan suatu jaringan yang menghubungkan computer diseluruh dunia tanpa dibatasi oleh jumlah unit menjadi satu jaringan yang bisa saling mengakses. Dengan internet tersebut, satu computer dapat berkomunikasi secara langsung dengan computer lain diberbagai belahan dunia.</p>
<p>Alasan mengapa era ini memberikan dampak yang cukup signifikan bagi berbagai aspek kehidupan:</p>
<ul>
<li>Informasi pada internet bisa diakses 24 jam dalam sehari</li>
</ul>
<ul>
<li>Biayamurah dan bahan gratis</li>
</ul>
<ul>
<li>Kemudahan akses informasi dan melakukan transaksi</li>
</ul>
<ul>
<li>Kemudahan membangun relasi dengan pelanggan</li>
</ul>
<ul>
<li>Materi dapat di up-date dengan mudah</li>
</ul>
<ul>
<li>Pengguna internet telah merambah ke segala penjuru</li>
</ul>
<p>Hadirnya internet dalam kehidupan manusia telah membentuk komunitas masyarakat tersendiri. Surat menyurat yang dulu dilakukan secara tradisional (merpati pos atau kantor pos) sekarang bisa dilakukan hanya dengan duduk dan mengetik surat tersebut di depan komputer.</p>
<p>Beberapa alasan mengenai pentingnya etika dalam duniamaya adalah sebagai berikut:</p>
<ul>
<li>Bahwa pengguna internet berasal dari berbagai negara yang mungkin memiliki budaya, bahasa dan adat istiadat yang berbeda-beda.</li>
</ul>
<ul>
<li>Pengguna internet merupakan orang-orang yang hidup dalam dunia anonymouse, yang tidak mengharuskan pernyataan identitas asli dalam berinteraksi.</li>
</ul>
<ul>
<li>Berbagai macam fasilitas yang diberikan dalam internet memungkinkan seseorang untuk bertindak etis seperti misalnya ada juga penghuni yang suka iseng dengan melakukan hal-hal yang tidak seharusnya dilakukan.</li>
<li>Harus diperhatikan bahwa pengguna internet akan selalu bertambah setiap saat dan memungkinkan masuknya &ldquo;penghuni&rdquo; baru di dunia maya tersebut.</li>
</ul>
<p>Netiket atau Nettiquette, adalah etika dalam berkomunikasi menggunakan internet.</p>
<ul>
<li>Netiket pada one to one communications</li>
</ul>
<p>Yang dimaksud dengan one to one communications adalah kondisi dimana komunikasi terjadi antarindividu &ldquo;face to face&rdquo; dalam sebuah dialog.</p>
<ul>
<li>Netiket pada one to many communications</li>
</ul>
<p>Konsep komunikasi one to meny communications adalah bahwa satu orang bisa berkomunikasi kepada beberapa orang sekaligus. Hal itu seperti yang terjadi pada mailing list dan net news.</p>
<p>Information services</p>
<p>Pada perkembangan internet, diberikan fasilitas dan berbagai layanan baru yang disebut layanan informasi(information service). Berbagai jenis layanan ini antara lain seperti Gropher, Wais, Word Wide Web (WWW), Multi-User Dimensions (MUDs), Multi-User Dimensions which are object Oriented (MOOs)</p>
<p>Seperti halnya etika dalam kehidupan bermasyarakat, sanksi yang diperoleh terhadap suatu pelanggaran adalah sanksi sosial. Sanksi sosial bisa saja berupa teguran atau bahkan dikucilkan dari kehidupan bermasyarakat. Demikian juga dengan pelanggaran etika berinternet. Sanksi yang akan diterima jikamelanggar etika atau norma-norma yang berlaku adalah dikucilkan dari kehidupan berkomunikasi berinternet.</p>
<p>sumber : <a href="http://vlyodhart.wordpress.com/2010/03/30/etika_inet/" target="_blank">vlyodhart</a></p>', '1', '0', '0', 'published', '0' ),
( '3', '1', '2012-05-24 00:00:00', 'blog,bla,bla,bla,bla', 'bla blog bla blog', 'Pekerjaan Tukang Sampah', '2', '5', 'pekerjaan-tukang-sampah', '<p>Siapa sih yang ga kenal ama pekerjaan ini ? pasti semua udah tau donk tukang sampah kerjaanya mungut-mungutin sampah yang ada di jalan atau komplek-komplek rumah kalian. Nah, kali ini saya ingin menjelaskan sedikit tentang pekerjaan ini, walaupun pekerjaan ini rendah tapi bisa dibilang mereka adalah PAHLAWAN KEBERSIHAN lho, ga percaya ? ya udah mending lanjut bacanya aja ya...</p>', '<p><img src="http://posterous.com/getfile/files.posterous.com/ganaspati/rPXKTj4OjoC2z3UrXzakjXGQ1gztRHp7AXROdWx8FnkNh2mDepLa4sOgqPd2/54904_tukang_sampah_menyusuri_.jpg" alt="Tukang Sampah" width="200" height="150" />Tukang sampah, ya...tukang sampah merupakan pekerjaan rendah yang mungkin sebagian orang menilai bahwa pekerjaan ini pekerjaan hina or apa lah yang berkaitan tentang sampah, bau dan jijik...</p>
<p>Hmmm..bisa dibayangkan ya qo mau sih orang-orang itu jadi tukang sampah. Ya mungkin karena faktor ekonomi or susahnya cari pekerjaan di Jakarta, maka mereka rela kerja jadi tukang sampah yang penting bisa hidup di Kota Metropolitan ini.</p>
<p>Pernah ga sih terfikir oleh kalian, pekerjaan tukang sampah itu apa aja sih ? ada ga sih aturan-aturan yang berlaku untuk pekerjaan ini ? Nah...kali ini saya mo ngebahas nih tentang deskripsi pekerjaan dari tukang sampah serta aturan-aturan apa saja sih yang berlaku pada pekerjaan ini.</p>
<p>Tukang sampah menurut deskripsi umum (deksripsi dari sudut pandang orang-orang) merupakan orang atau sekelompok orang yang memilih atau mempunyai kegiatan atau pekerjaan untuk membersihkan lingkungan sekitar dari benda atau barang yang sudah tidak terpakai dan tidak bisa digunakan kembali yang dikategorikan sebagai sampah.</p>
<p>Kita dah tau kan deksripsi dari tukang sampah itu seperti apa, nah untuk detail pekerjaanya sendiri seperti apa sih tukang sampah itu ? Ada tidak sih aturan-aturan yang berlaku pada pekerjaan ini ?? Eit..jangan salah, walaupun pekerjaan ini di anggap sederhana, tetapi pekerjaan tukang smapah ini mempunyai aturan atau <em>Etika</em> yang harus dijalani dan dipatuhi.</p>
<p>Adapun aturan atau Etika dari pekerjaan tukang sampah ini adalah :</p>
<ol>
<li>Harus bertindak jujur.</li>
<li>Pekerjaan dimulai dari pukul 05.00 pagi hingga pukul 09.00.</li>
<li>Pengangkutan sampah dilakukan 1 minggu 2x (ada beberapa diantaranya 1 minggu 3x tergantung dari kebijakan RT serta warga setempat).</li>
<li>Harus mengangkut semua sampah-sampah yang berada pada rute atau wilayah kerja masing-masing dan tidak boleh ada 1 pun yang tertinggal.</li>
<li>Bertanggungjawab pada rute atau wilayah kerja yang telah di tentukan.</li>
<li>Tidak diperbolehkan meminta uang atau pungutan apapun yang bersifat pribadi.</li>
<li>Tidak diperbolehkan mengambil barang-barang atau benda apapun yang tidak ada kaitannya dengan sampah.</li>
</ol>
<p>Kira-kira seperti itulah aturan-aturan yang berlaku bagi para pekerja tukang sampah tersebut. Walaupun tidak tertulis akan tetapi hal ini harus di patuhi kepada setiap pekerja tukang sampah tersebut. Bila ada salah satu hal yang dilanggar ataupun pengaduan dari warga atau seseorang tentang tingkah laku yang kurang baik dari para pekerja tukang sampah tersebut, maka akan diberi sanksi berupa di berhentikan dari pekerjaannya sebagai tukang sampah.</p>
<p><img src="http://farm3.static.flickr.com/2557/4042286166_2d145d01b9.jpg" alt="" width="200" height="150" />Hmm...sungguh berat memang pekerjaan menjadi tukang sampah, walaupun saya tidak pernah melakukan pekerjaan tersebut akan tetapi saya bisa membayangkan alangkah sulitnya mengerjakan pekerjaan tersebut. Membawa gerobak sampah dan keliling-keliling wilayah kerja atau rute yang telah ditentukan dan juga bergelut dengan bau-bau yang tidak sedap. Wah..!! tidak bisa dibayangkan !!!</p>
<p>Sungguh salut saya kepada orang-orang yang mau melakukan pekerjaan tersebut. Mereka juga bisa dibilang sebagai PAHLAWAN KEBERSIHAN. Loh ? kenapa ?? ya coba anda bayangkan, bila tidak ada orang seperti mereka, kita sendiri yang harus membawa sampah-sampah kita ke daerah Tempat Pembuangan Akhir (TPA) atau Tempat Pembuangan Sampah (TPS). Apakah anda mau melakukan hal itu ?? Nah bisa dibayangkan kan, begitu berharganya tukang sampah tersebut. Tanpa mereka lingkungan kita tidak akan bisa bersih dari sampah.</p>', '1', '0', '0', 'published', '0' ),
( '4', '1', '2011-04-09 00:00:00', '', '', 'Sanksi Pelanggaran Kode Etik Programmer', '1', '0', 'sanksi-pelanggaran-kode-etik-programmer', '<p><span><img style="float: left; margin:5px;" src="http://www.funnycatsite.com/pictures/Programmer_Cat.jpg" alt="Programmer" width="105" height="78" /></span>Programmer adalah orang yang bekerja membuat atau merancang sebuah system untuk membantu memudahkan pekerjaan manusia yang menggunakan media Komputer. Sekarang ini banyak sekali Programmer-programmer baik freelance maupun yang tidak berlomba membuat sebuah system yang bisa dibilang canggih dan bermanfaat bagi manusia. Benarkah seorang programmer kebal akan hukum apabila melanggar kode Etik programmer ?</p>', '<p>Programmer adalah individu yang bertugas dalam hal rincian implementasi, pengemasan, dan modifikasi algoritma serta struktur data, dituliskan dalam sebuah bahasa pemrograman tertentu.<br />Berikut ini adalah beberapa kode etik yang disadur berdasarkan kode etik yang kini digunakan oleh perkumpulan programmer internasional yang berlaku saat ini :</p>
<ol>
<li>Seorang programmer tidak boleh membuat atau mendistribusikan Malware.</li>
<li>Seorang programmer tidak boleh menulis kode yang sulit diikuti dengan sengaja.</li>
<li>Seorang programmer tidak boleh menulis dokumentasi yang dengan sengaja untuk membingungkan atau tidak akurat.</li>
<li>Seorang programmer tidak boleh menggunakan ulang kode dengan hak cipta kecuali telah membeli atau telah meminta izin.</li>
<li>Tidak boleh mencari keuntungan tambahan dari proyek yang didanai oleh pihak kedua tanpa izin.</li>
<li>Etika profesi yang berlaku bagi programmer di indonesia. Tidak boleh mencuri software khususnya development tools.</li>
<li>Tidak boleh menerima dana tambahan dari berbagai pihak eksternal dalam suatu proyek secara bersamaan kecuali mendapatkan izin.</li>
<li>Tidak boleh menulis kode yang dengan sengaja menjatuhkan kode programmer lain untuk mengambil keuntungan dalam menaikkan status.</li>
<li>Tidak boleh membeberkan data-data penting karyawan dalam perusahaan.</li>
<li>Tidak boleh memberitahu masalah keuangan pada pekerja dalam pengembangan suatu proyek.</li>
<li>Tidak pernah mengambil keuntungan dari pekerjaan orang lain.</li>
<li>Tidak boleh mempermalukan profesinya.</li>
<li>Tidak boleh secara asal-asalan menyangkal adanya bug dalam aplikasi.</li>
<li>Tidak boleh mengenalkan bug yang ada di dalam software yang nantinya programmer akan mendapatkan keuntungan dalam membetulkan bug.</li>
<li>Terus mengikuti pada perkembangan ilmu komputer.</li>
</ol>
<p>Adakah sanksi atau hukuman yang debirkan kepada seorang Programmer bila melanggar sanksi tersebut ? Mungkin sebagian orang menganggap bahwa pekerjaan Programmer adalah pekerjaan yang baik-baik saja. Tentu tidak, ada sebagian Programmer justru menggunakan kemampuannya untuk melakukan tindak kejahatan dan merugikan orang lain.</p>
<p>Adapun beberapa pelanggaran yang umum dan sering terjadi adalah sebagai berikut :</p>
<ul>
<li>Pelanggaran Copyright<br /><br />Pelanggaran ini merupakan pelanggaran dimana seorang programmer menggunakan ulang kode dengan hak cipta orang lain atau perusahaan lain dan menjual atau mengkomersilkan kembali kode tersebut dengan mengatas namakan hak cipta programmer tersebut. Untuk pelanggaran ini seorang programmer bisa diberikan sanksi berupa sanksi Hukum baik hukum pidana atau pun hukum perdata.</li>
</ul>
<ul>
<li>Pembuatan Virus Komputer<br /><br />Pelanggaran ini merupakan pelanggaran dimana seorang programmer dengan sengaja membuat sebuah Program Virus, dan menyebarkannya ke semua komputer di dunia melalui jaringan internet. Untuk kasus ini bisa dibilang cukup sulit, dikarenakan banyak programmer pembuat virus tersebut menginisialkan nama aslinya sehingga sulit untuk melacak keberadaannya. <br /><br />Untuk pelanggaran ini, bisa diberikan sanksi berupa sanksi Hukum bila programmer tersebut terbukti dan tertangkap membuat program virus tersebut.</li>
</ul>
<ul>
<li>Pembuatan Software Cracking<br /><br />Untuk pelanggaran yang satu ini merupakan pelanggaran dimana seorang programmer membuat sebuah Aplikasi yang memungkinkan menjadikan Software berbayar menjadi Free alias Gratis.<br /><br />Untuk pelanggaran ini, bisa diberikan sanksi berupa sanksi Hukum karena melanggar hak cipta dari pengembang software asli.</li>
</ul>
<ul>
<li>Hacking<br /><br />Merupakan pelanggaran yang cukup banyak ditemui sekarang ini. Banyak sekali website-website yang terkena hacking oleh para hacker-hacker dunia. Dan tidak hanya merubah tampilan halaman sebuah website saja, kadang juga beberapa hacker ada yang membuat Server dari hosting website tersebut Down alias Hank dan tidak bisa beroperasi selama beberapa jam atau menit.<br /><br />Untuk pelanggaran tersebut belum ada sanksi yang jelas, dan sedikit sulit untuk menangkap tersangka Hacker tersebut karena menggunakan nama inisial. Untuk di Indonesia sudah ada UU yang menangani masalah tersebut yaitu UU ITE.</li>
</ul>
<ul>
<li>Carding<br /><br />Pelanggaran ini merupakan pelanggaran seorang programmer dimana programmer tersebut mengumpulkan data Kartu Kredit atau Akun Bank dari seseorang dan kemudia disalahgunakan dengan memindahkan sejumlah uang atau menggunakan uang hasil pengumpulan data tersebut.<br /><br />Untuk pelanggaran ini bisa dikenakan Sanksi Hukum dan masuk kedalam kategori Hukum Pidana maupun Perdata bila pelaku tertangkap dan terdapat bukti yang menguatkan.</li>
</ul>
<p><br />Itulah beberapa pelanggaran yang sering terjadi pada dunia Programmer. Masih banyak pelanggaran lainnya yang tidak dapat saya sampaikan. Mungkin anda bisa mencarinya di Google.. :)</p>
<p>&nbsp;</p>
<p>Download artikel ini : <a title="dowload" href="http://www.i-fuk.com/downloads/sanski_dan_etika_programer.pdf" target="_blank">Sanksi Pelanggaran Kode Etik Programmer</a></p>', '1', '0', '0', 'published', '0' ),
( '5', '1', '2011-05-02 00:00:00', '', '', 'Manusia dan Kasih Sayang', '3', '0', 'manusia-dan-kasih-sayang', '<p>Pengertian kasih sayang menurut kamus umum bahasa indonesia karangan W.J.S.Poerwadamlinta adalah perasaan sayang. perasaan cinta atau perasaan suka kepada seseorang.</p>', '<p>Dalam kehidupan berumah tangga kasih sayang merupakan kunci kebahagiaan. Kasih sayang ini merupakan pertumbuhan dari cinta. Percintaan muda-mudi (pria-wanita) bila diakhiri dengan perkawinan, maka didalam berumah tangga keluarga muda itu bukan lagi bercinta-cintaan. tetapi sudah bersifat kasih mengasihi atau saling menumpahkan kasih sayang.<br /><br />Dalam kasih sayang sadar atau tidak sadar dari masing-masing pihak dituntut tanggung jawab, pengorbanan, kejujuran. saling percaya, saling pengertian, saling terbuka, sehingga keduanya merupakan kesatuan yang bulat dan utuh. Bila salah satu unsur kasih sayang hilang, misalnya unsur tanggung jawab, maka retaklah keutuhan rumah tangga itu. Kasih sayang yang tidak disertai kejujuran, terancamlah kebahagiaan rumah tangga itu.<br /><br />Yang dapat merasakan kasih sayang bukan hanya suami atau istri atau anak-anak yang telah dewasa, melainkan sejak bayi kita telah dapat merasakan kasih sayang dari ayah dan ibunya. Bayi dapat mengenal suara atau sentuhan tangan ayah ibunya. Bagaimana sikap ibunya memegang/menggendong telah dikenalnya. Hal ini karena sang bayi telah mempunyai kepribadian.</p>
<p>Kasih sayang, dasar komunikasi dalam suatu keluarga. Komunikasi antara anak dan orang tua. pada prinsipnya anak terlahir dan terbentuk sebagai hasil curahan kasih sayang orang tuanya. Pengembangan watak anak dan selanjutnya tak boleh lepas dari kasih sayang dan pematian orang tua. Suatu hubungan yang harmonis akan terjadi bila hal itu terjadi secara timbal balik antara orang tua dan anak.<br /><br />Suatu kasus yang sering teIjadi, yang menyebabkan seseorang menjadi mortinis, keberandalan remaja, frustasi dan sebaginya, dimana semuanya dilatar belakangi kurangnya pematian dan kasih sayang dalam kehidupan keluarganya.<br /><br />Adanya kasih sayang ini mempengaruhi kehidupan si anak dalam masyarakat. Orang tua dalam memberikan kasih sayangnya bennacam-macam demikian pula sebaliknya. Dari cara pemberian cinta kasih ini dapat dibedakan :</p>
<ol>
<li><strong>Orang tua bersifat aktif, si anak bersifat pasif.</strong><br />Dalam hal ini orang tua memberikan kasih sayang terhadap anaknya baik berupa moral-materiil dengan sebanyak-banyaknya, dan si anak menerima saja, mengiyakan, tanpa memberikan respon. Hal ini menyebabkan si anak menjadi takut, kurang berani dalam masyarakat, tidak berani menyatakan pendapat, minder, sehingga si anak tidak mampu berdiri sendiri di dalam masyarakat.</li>
<li><strong>Orang tua bcrsifat pasif, si anak bersifat aktif.</strong><br />Dalam hal ini si anak berlebih-Iebihan memberikan kasih sayang terhadap orang tuanya, kasih sayang ini diberikan secara sepihak, orang tua mendiamkan saja tingkah laku si anak, tidak memberikan perhatian apa yang dipemuat si anak.</li>
<li><strong>Orang tua bersifat pasif, si anak bersifat pasif.</strong><br />Di sini jelas bahwa masing-masing membawa hidupnya, tingkah lakunya sendiri-sendiri, tanpa saling memperhatikan. Kehidupan keluarga sangat dingin, tidak ada kasih sayang, masing-masing membawa caranya sendiri, tidak ada tegur sapa jika tidak perlu, orang tua hanya memenuhi dalam bidang materi saja.</li>
<li><strong>Orang tua bersifat aktif, si anak bersifat aktif</strong>.<br />Dalam hal ini orang tua dan anak saling memberikan kasih sayang dengan sebanyak-banyaknya. Sehingga hubungan antara orang tua dan anak sangat intim dan mesra, saling mencintai, saling menghargai, saling membutuhkan.</li>
</ol>
<p><br />Kasih sayang itu nampak sekali bila seorang ibu sedang menyusui atau menggendong, bayinya itu diajak bercakap-cakap, ditimang-timang, dinyanyikan, meskipun bayi itu tak tabu arti kata-kata, lagu dan sebagainya.</p>', '1', '0', '1', 'published', '0' ),
( '6', '1', '2011-05-03 00:00:00', '', '', 'Manusia dan Cinta', '4', '0', 'manusia-dan-cinta', '<p>Cinta adalah rasa sangat suka (kepada) atau (rasa) sayang (kepada). ataupun (rasa) sangat kasih atau<br />sangat tertarik hatinya.</p>', '<p>Cinta memegang peranan yang penting dalam kehidupan manusia. sebab cinta merupakan landasan dalam kehidupan perkawinan, pembentukan keluarga dan pemeliharaan anak, hubungan yang erat dimasyarakat dan hubungan manusiawi yang akrab. Demikian pula cinta adalah pengikat yang kokoh antara manusia dengan Tuhannya sehingga manusia menyembah Tuhan dengan ikhlas, mengikuti perintah-Nya, dan berpegang teguh pada syariat-Nya.</p>
<p>Cinta kepada sesama adalah perasaan simpati yang melibatkan emosi yang mendalam Menurut Erich Fromm, ada empat syarat untuk mewujudkan cinta kasih, yaitu:</p>
<ol>
<li>Knowledge (pengenalan)</li>
<li>Responsibilty (tanggung jawab)</li>
<li>Care (perhatian)</li>
<li>Respect (saling menghormati)</li>
</ol>
<p>Cinta berada di seluruh semua kebudayaan manusia. Oleh karena perbedaan kebudayaan ini, maka pendefinisian dari cinta pun sulit ditetapkan. Para pakar telah mendefinisikan dan memilah-milah istilah ini yang pengertiannya sangat rumit. Antara lain mereka membedakan cinta terhadap sesama manusia dan yang terkait dengannya menkadi:</p>
<ol>
<li>Cinta terhadap keluarga</li>
<li>Cinta terhadap teman-teman, atau philia</li>
<li>Cinta yang romantis atau juga disebut asmara</li>
<li>Cinta yang hanya merupakan hawa nafsu atau cinta eros</li>
<li>Cinta sesama atau juga disebut kasih sayang atau agape</li>
<li>Cinta dirinya sendiri, yang disebut narsisme</li>
<li>Cinta akan sebuah konsep tertentu</li>
<li>Cinta akan negaranya atau patriotisme</li>
<li>Cinta akan bangsa atau nasionalisme</li>
</ol>
<p>&nbsp;</p>', '1', '0', '1', 'published', '0' ),
( '7', '1', '2011-05-04 00:00:00', '', '', 'Wujud dan perilaku Manusia akan Keindahan Alam', '5', '0', 'wujud-dan-perilaku-manusia-akan-keindahan-alam', '<p>Keindahan diartikan sebagai keadaan yang enak dipandang, cantik, bagus  benar atau elok. Keindahan juga dapat memberikan kita rasa keingintahuan  tentang hal tersebut semakin terus bertambah. Alam sudah menciptakan  pepohonan dengan keindahan tersendiri. Namun manusia juga bisa  menambahkan keindahan dengan cara merawat alam(pepohonan) dengan baik  sehingga alam juga akan terasa lebih indah.</p>', '<p>Menikmati keindahan alam bisa dengan berbagai cara, contohnya alam yang ada di daerah bali, Pulau Bali sudah  dikenal diseluruh dunia dengan keindahan yang tidak ada bandingannya.  Keindahan alam dan kekayaan adat istiadatnya menjadi salah satu daya  tarik bagi para tour di bali jalanjalan mengunjungi obyek-obyek. Mulai  dari obyek wisata alam, wisata seni dan budaya, sampai dengan atraksi  wisata semua ada di Bali. Untuk dapat menikmati semua keindahan yang  ditawarkan oleh pulau Bali Misalnya ke pulau dewata (Bali). Mereka hanya  ingin melihat dan merasakan keindahan alam bali dengan pantai yang  indah, pasir putih yang masih elok, dan ombak yang ideal.</p>
<p><br /><span style="font-size: medium;"><strong>CINTA AKAN LINGKUNGAN<br /></strong></span>Lingkungan yang bersih sangat mempengaruhi setiap kehidupan manusia.  Jika lingkungan disekitar itu bersih dan sehat maka kita juga akan  merasa sehat dan nyaman. Sebaliknya jika lingkungan disekeliling kita  kotor maka kita juga akan merasa tidak sehat. Oleh karena itu kita harus  menjaga agar lingkungan disekitar kita bersih .</p>
<p>Caranya dengan menanam pohon atau tumbuh-tumbuhan apa saja disekitar  halaman rumah. Tanaman itu sangat bagus untuk kehidupan manusia, karena  tanaman akan mengeluarkan oksigen yang sangat dibutuhkan oleh manusia.  Contohnya, jika kita berada dibawah pohon maka kita akan merasa sejuk.  Itu karena pohon megeluarkan oksigen yang akan kita butuhkan. Jadi  kesimpulannya kita harus banyak menanam tanaman dan harus selalu  merawatnya.</p>
<p>Bukan hanya dengan banyak menanam pohon saja, kita juga harus membuat  lingkungan disekitar kita bersih. Contoh lingkungan kotor juga dapat  berasal dari air. Selama ini kita tenang-tenang saja mencuci pakaian  dengan diterjen. Selain praktis dan mudah didapat, hasilnya pun  memuaskan. Namun, pilihan itu diam-diam membawa dampak lingkungan.  Seperti diketahui, deterjen merupakan produk sintesis. Penggunaannya  akan menimbulkan polusi berupa peningkatan pH air. Kalau keasaman air  tinggi, kehidupan organisme di dalamnya dapat terganggu. Semakin tinggi  penggunaan pembersih sintesis ini di masyarakat luas, tentunya  lingkungan perairan disekitar pemukiman penduduk akan makin tercemar,  termasuk sungai-sungai yang menjadi sumber air baku bagi perusahaan air  minum.</p>
<p>Lalu, apa yang bisa kita lakukan agar bisa mencuci tanpa rasa  bersalah?Banyak hal yang bisa dilakukan. Misalnya memakai sabun colek  untuk mencuci, selain tidak merusak tangan, sabun colek tidak mengganggu  lingkungan. Selain semua cara-cara yang efektif yang disebutkan tadi,  untuk membuat lingkungan disekitar kita bersih dan sehat kita juga harus  mencintai alam dan lingkungan kita. Kita harus tau bagaimana cara  merawat tanaman dengan baik supaya tanaman itu tumbuh subur dan dapat  menambah penghijauan.</p>', '1', '0', '0', 'published', '0' ),
( '8', '1', '2011-05-05 00:00:00', '', '', 'Manusia dan Penderitaan', '2', '0', 'manusia-dan-penderitaan', '<p>Penderitaan adalah sebuah kata yang sangat dijauhi dan paling tidak disenangi oleh siapapun. Berbicara tentang penderitaan ternyata penderitaan tersebut berasal dari dalam dan luar diri manusia. Biasanya orang menyebut dengan factor internal dan faktor eksternal.</p>', '<p>Dalam diri manusia itu ada cipta, rasa dan karysa. Karsa adalah sumber  yang menjadi penggerak segala aktivitas manusia. Cipta adalah realisasi  dari adanya karsa dan rasa. Baik karsa maupun rasa selalu ingin  dipuaskan. Karena selalu ingin dilayani, sedangkan rasa selalu ingin  dipenuhi tuntutannya. Baru dalam keduanya menemukan yang dicarinya atau  diharapkan manusia akan merasa senang, merasa bahagia.<br /> <br /> Apabila karsa dan rasa tidak terpenuhi apa yang dimaksudkan, manusia  akan mendata rasa kurang mengakibatkan munculnya wujud penderitaan,  bahkan lebih dari itu, yaitu rasa takut.<br /> <br /> Rasa takut itu justru sudah menyelinap dan dating menyerang kita sebelum  bencana atau bahaya itu dating menyerangnya. Sekarang yang paling  penting adalah bagaimana upaya kita meniadakan rasa kurang dan rasa  takut itu. Karena kedua rasa itu termasuk penyakit batin masuia, maka  usaha terbaik ialah menyehatkan bathin itu sendiri, rasa kurang itu  muncul dikarenakan adanya anggapan lebih pada pihak lain.<br /> <br /> Kita sudah tahu bahwa factor &ndash; factor yang mempengaruhi penderitaan itu  adalah factor internal dan faktor eksternal. Eksternal datangnya dari  luar diri manusia. Factor ini dapat dibedakan atas dua macam ; yaitu  eksternal murni dan tak murni. Eksternal murni adalah penyebab yang  benar &ndash; benar berasal dari luar diri manusia yang bersangkutan.  Penderitaan itu tidak bukan merupakan akibat ulah manusia yang  bersangkutan.</p>', '0', '0', '0', 'published', '0' ),
( '9', '1', '2011-05-09 00:00:00', '', '', 'Manusia dan Tanggung Jawab', '1', '0', 'manusia-dan-tanggung-jawab', '<p>Tanggung jawab menurut kamus umum Bahasa Indonesia adalah, keadaan wajib menanggung segala sesuatunya atau berkewajiban menanggung, memikul jawab, menanggung segala sesuatunya, atau memberikan jawab dan menanggung akibatnya.</p>', '<p><span style="font-size: medium;"><strong>MACAM-MACAM TANGGUNG JAWAB</strong></span><br />Manusia itu berjuang memenuhi keperluannya sendiri atau untuk keperluan pihak lain. Untuk itu ia manghadapi manusia lain dalam masyarakat atau menghadapi lingkungan alam. Dalam usahanya itu manusia juga menyadari bahwa ada kekuatan lain yang ikut menentukan yaitu kekuasaan Tuhan. Dengan demikian tanggung jawab itu dapat dibedakan menurut keadaan manusia atau hubungan yang dibuatnya. Atas dasar ini, lalu dikenal beberapa jenis tanggung jawab. yaitu :</p>
<ol>
<li><strong>Tanggung jawab terhadap diri sendiri</strong><br />Tanggug jawab terhadap diri sendiri menuntut kesadaran setiap orang untuk memenuhi kewajibannya sendiri dalam mengembangkan kepribadian sebagai manusia pribadi. Dengan demikian bisa menyelesaikan masalah-masalah kemanusiaan mengenai dirinya sendiri Menurut sifat dasarnya manusia adalah mahluk bernlOral, tetapi manusia juga seorang pribadi. Karena merupakan seorang pribadi maka manusia mempunyai pendapat sendiri. perasaan sendiri, angan-angan sendiri. Sebagai perwujudan dari pendapat:, perasaan dan angan-angan itu manusia berbuat dan bertindak. Dalam hal ini manusia tidak luput dari kesalahan, kekeliruan, baik yang disengaja maupun tidak.</li>
<li><strong>Tanggung jawab terhadap keluarga</strong><br />Keluarga merupakan masyarakat keeil. Keluarga terdiri dari suami-istri, ayah-ibu dan anak-anak. dan juga orang lain yang menjadi anggota keluarga. Tiap anggota keluarga wajib bertanggung jawab kepada keluarganya. Tanggung jawab ini menyangkut nama baik keluarga. Tetapi tanggung jawab juga merupakan kesejahteraan, keselamatan, pendidikan. dan kehidupan. </li>
<li><strong>Tanggung jawab terhadap Masyarakat</strong> <br />Pada hakekatnya manusia tidak bisa hidup tanpa bantuan manusia lain, sesuai dengan kedudukannya sebagai mahluk sosial. Karena membutuhkan manusia lain maka ia harns berkomunikasi dengan manusia lain tersebut. Sehingga dengan demikian manusia di sini merupakan anggota masyarakat yang tentunya mempunyai tanggung jawab seperti anggota masyarakat yang lain agar dapat melangsungkan hidupnya dalam masyarakat tersebut. Wajarlah apabila segala tingkah laku dan perbuatannya harns dipertanggung jawabkan kepada masyarakat.</li>
<li><strong>Tanggung jawab kepada Bangsa / Negara</strong><br />Suatu kenyataan lagi, bahwa tiap manusia, tiap individu adalah warga negara suatu negara. Dalam berpikir, berbuat, bertindak, bertingkah laku manusia terikat oleh norma-norma atau ukuran-ukuran yang dibuat oleh negara. Manusia tidak dapat berbuat semaunya sendiri. Bila perbuatan manusia itu salah, maka ia hams bertanggung jawab kepada negara.</li>
<li><strong>Tanggung jawab terhadap Tuhan</strong><br />Tuhan menciptakan manusia di bumi ini bukanlah tanpa tanggung jawab, melainkan untuk mengisi kehidupannya manusia mempunyai tanggung jawab langsung temadap Tuhan. Sehingga tindakan manusia tidak bisa lepas dari hukuman-hukuman Tuhan yang dituangkan dalam berbagai kitab suci melalui berbagai macam agama. Pelanggaran dari hukuman-hukuman tersebut akan segera diperingatkan oleh Tuhan dan jika dengan peringatan yang keraspun manusia masih juga tidak menghiraukan maka Tuhan akan melakukan kutukan. Sebab dengan mengabaikan perintah-perintah Tuhan berarti mereka meninggalkan tanggung jawab yang seharusnya dilakukan manusia temadap Tuhan sebagai penciptanya, bahkan untuk memenuhi tanggung jawabnya, manusia perlu pengorbanan.</li>
</ol>', '1', '0', '0', 'published', '0' );
-- ---------------------------------------------------------


-- Dump data of "if_posts_to_categories" -------------------
INSERT INTO `if_posts_to_categories`(`id`,`post_id`,`category_id`) VALUES 
( '1', '1', '1' );
-- ---------------------------------------------------------


-- Dump data of "if_settings" ------------------------------
INSERT INTO `if_settings`(`name`,`value`) VALUES 
( 'admin_email', 'admin@simplacms.com' ),
( 'allow_registrations', '0' ),
( 'enabled', '1' ),
( 'enable_atom_comments', '1' ),
( 'enable_atom_posts', '1' ),
( 'enable_captcha', '0' ),
( 'enable_delicious', '0' ),
( 'enable_digg', '0' ),
( 'enable_furl', '0' ),
( 'enable_reddit', '0' ),
( 'enable_rss_comments', '1' ),
( 'enable_rss_posts', '1' ),
( 'enable_stumbleupon', '0' ),
( 'enable_technorati', '0' ),
( 'links_per_box', '5' ),
( 'meta_keywords', 'cms,simpla,ci,codeigniter,code,hml,css,cms blog,openblog' ),
( 'months_per_archive', '5' ),
( 'offline_reason', 'scriptnya blom jadi..hahahahahah...hihihihihihih...heheheheh' ),
( 'posts_per_page', '5' ),
( 'recognize_user_agent', '1' ),
( 'site_description', 'Simpla CMS is just simple CMS for Blog like wordpress but still different.' ),
( 'site_title', 'If-Blog' );
-- ---------------------------------------------------------


-- Dump data of "if_sidebar" -------------------------------
INSERT INTO `if_sidebar`(`id`,`title`,`file`,`status`,`position`) VALUES 
( '1', 'Search', 'search', 'enabled', '1' ),
( '2', 'Archive', 'archive', 'enabled', '2' ),
( '3', 'Categories', 'categories', 'enabled', '3' ),
( '4', 'Tag_cloud', 'tag_cloud', 'enabled', '4' ),
( '5', 'Feeds', 'feeds', 'enabled', '5' ),
( '6', 'Links', 'links', 'enabled', '6' ),
( '7', 'Other', 'other', 'enabled', '7' );
-- ---------------------------------------------------------


-- Dump data of "if_tags" ----------------------------------
INSERT INTO `if_tags`(`id`,`name`) VALUES 
( '1', 'codeigniter' ),
( '2', 'blog' );
-- ---------------------------------------------------------


-- Dump data of "if_tags_to_posts" -------------------------
INSERT INTO `if_tags_to_posts`(`id`,`tag_id`,`post_id`) VALUES 
( '1', '1', '1' ),
( '2', '2', '1' );
-- ---------------------------------------------------------


-- Dump data of "if_templates" -----------------------------
INSERT INTO `if_templates`(`id`,`name`,`author`,`path`,`image`,`is_default`) VALUES 
( '1', 'IfBlog', 'ifthenuk', 'default', 'ifblog.jpg', '1' ),
( '2', 'Beautiful Day', 'Arcsin', 'beautiful_day', 'beautiful_day.jpg', '0' );
-- ---------------------------------------------------------


-- Dump data of "if_users" ---------------------------------
INSERT INTO `if_users`(`id`,`ip_address`,`username`,`password`,`email`,`activation_selector`,`activation_code`,`forgotten_password_selector`,`forgotten_password_code`,`forgotten_password_time`,`remember_selector`,`remember_code`,`created_on`,`last_login`,`active`,`first_name`,`last_name`,`company`,`phone`) VALUES 
( '1', '127.0.0.1', 'administrator', '$2y$08$200Z6ZZbp3RAEXoaWcMA6uJOFicwNZaqk4oDhqTUiFXFe63MG.Daa', 'admin@admin.com', NULL, '', NULL, NULL, NULL, NULL, NULL, '1268889823', '1268889823', '1', 'Admin', 'istrator', 'ADMIN', '0' );
-- ---------------------------------------------------------


-- Dump data of "if_users_groups" --------------------------
INSERT INTO `if_users_groups`(`id`,`user_id`,`group_id`) VALUES 
( '1', '1', '1' ),
( '2', '1', '2' );
-- ---------------------------------------------------------


-- CREATE INDEX "fk_if_users_groups_groups1_idx" ---------------
CREATE INDEX `fk_if_users_groups_groups1_idx` USING BTREE ON `if_users_groups`( `group_id` );
-- -------------------------------------------------------------


-- CREATE INDEX "fk_if_users_groups_users1_idx" ----------------
CREATE INDEX `fk_if_users_groups_users1_idx` USING BTREE ON `if_users_groups`( `user_id` );
-- -------------------------------------------------------------


-- CREATE LINK "fk_if_users_groups_groups1" --------------------
ALTER TABLE `if_users_groups`
	ADD CONSTRAINT `fk_if_users_groups_groups1` FOREIGN KEY ( `group_id` )
	REFERENCES `if_groups`( `id` )
	ON DELETE Cascade
	ON UPDATE No Action;
-- -------------------------------------------------------------


-- CREATE LINK "fk_if_users_groups_users1" ---------------------
ALTER TABLE `if_users_groups`
	ADD CONSTRAINT `fk_if_users_groups_users1` FOREIGN KEY ( `user_id` )
	REFERENCES `if_users`( `id` )
	ON DELETE Cascade
	ON UPDATE No Action;
-- -------------------------------------------------------------


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
-- ---------------------------------------------------------


