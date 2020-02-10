/*
 Navicat Premium Data Transfer

 Source Server         : local
 Source Server Type    : MySQL
 Source Server Version : 50719
 Source Host           : localhost:3306
 Source Schema         : if_blog_data

 Target Server Type    : MySQL
 Target Server Version : 50719
 File Encoding         : 65001

 Date: 10/02/2020 12:20:58
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for if_categories
-- ----------------------------
DROP TABLE IF EXISTS `if_categories`;
CREATE TABLE `if_categories`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `url_name` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `description` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of if_categories
-- ----------------------------
INSERT INTO `if_categories` VALUES (1, 'Uncategorized', 'uncategorized', 'Uncategorized');
INSERT INTO `if_categories` VALUES (2, 'Freebies', 'freebies', 'cat for freebies');
INSERT INTO `if_categories` VALUES (3, 'Codeigniter', 'codeigniter', 'categories for codeigniter post');
INSERT INTO `if_categories` VALUES (4, 'Flutter', 'flutter', 'categories for flutter post');
INSERT INTO `if_categories` VALUES (5, 'Problem Solved', 'problem_solved', 'categories for problem solved post');
INSERT INTO `if_categories` VALUES (7, 'Jualan', 'jualan', 'Jualan Description');

-- ----------------------------
-- Table structure for if_comments
-- ----------------------------
DROP TABLE IF EXISTS `if_comments`;
CREATE TABLE `if_comments`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_parent` int(11) NULL DEFAULT NULL,
  `post_id` int(11) NULL DEFAULT 0,
  `user_id` int(11) NULL DEFAULT NULL,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `url` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `author_ip` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `comment` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `date` datetime(0) NULL DEFAULT CURRENT_TIMESTAMP,
  `show` enum('Y','N') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of if_comments
-- ----------------------------
INSERT INTO `if_comments` VALUES (1, NULL, 3, NULL, 'test', 'test@email.com', NULL, '127.0.0.1', 'aaaaaaaaaaa', '2020-02-10 10:35:01', 'N');
INSERT INTO `if_comments` VALUES (2, NULL, 3, NULL, 'test2', 'test2@email.com', NULL, '127.0.0.1', 'bbbbbbbbbbb', '2020-02-10 10:35:30', 'N');
INSERT INTO `if_comments` VALUES (3, NULL, 3, NULL, 'test3', 'test3@email.com', NULL, '127.0.0.1', 'cccccccccccc', '2020-02-10 10:35:55', 'N');
INSERT INTO `if_comments` VALUES (4, NULL, 3, NULL, 'test4', 'test4@email.com', NULL, '127.0.0.1', 'dddddd', '2020-02-10 10:37:18', 'N');
INSERT INTO `if_comments` VALUES (5, NULL, 3, NULL, 'test5', 'test5@email.com', NULL, '127.0.0.1', 'eeeeeeeeeee', '2020-02-10 10:37:18', 'N');
INSERT INTO `if_comments` VALUES (6, NULL, 3, NULL, 'test6', 'test6@email.com', NULL, '127.0.0.1', 'fffffffffff', '2020-02-10 10:37:18', 'N');
INSERT INTO `if_comments` VALUES (7, NULL, 3, NULL, 'test7', 'test7@email.com', NULL, '127.0.0.1', 'ggggggggg', '2020-02-10 10:37:18', 'N');
INSERT INTO `if_comments` VALUES (8, NULL, 3, NULL, 'test8', 'test8@email.com', NULL, '127.0.0.1', 'hhhhhhhh', '2020-02-10 10:37:18', 'N');
INSERT INTO `if_comments` VALUES (9, NULL, 3, NULL, 'test9', 'test9@email.com', NULL, '127.0.0.1', 'iiiiiiiiii', '2020-02-10 10:37:18', 'N');
INSERT INTO `if_comments` VALUES (10, NULL, 3, NULL, 'test10', 'test10@email.com', NULL, '127.0.0.1', 'jjjjjjjjjj', '2020-02-10 10:37:18', 'N');
INSERT INTO `if_comments` VALUES (11, NULL, 3, NULL, 'test11', 'test11@email.com', NULL, '127.0.0.1', 'kkkkkkkkkk', '2020-02-10 10:37:18', 'N');
INSERT INTO `if_comments` VALUES (12, NULL, 3, NULL, 'test12', 'test12@email.com', NULL, '127.0.0.1', 'lllllllll', '2020-02-10 10:37:18', 'N');
INSERT INTO `if_comments` VALUES (14, 1, 3, NULL, 'administrator', NULL, NULL, '::1', 'Oke coba reply comment lagi', '2020-02-10 12:10:52', 'Y');

-- ----------------------------
-- Table structure for if_groups
-- ----------------------------
DROP TABLE IF EXISTS `if_groups`;
CREATE TABLE `if_groups`  (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `description` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `permission` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of if_groups
-- ----------------------------
INSERT INTO `if_groups` VALUES (1, 'admin', 'Administrator', '[\"accessModComments\",\"replyComments\",\"updateComments\",\"viewComments\",\"deleteComments\",\"accessModNavigation\",\"createNavigation\",\"updateNavigation\",\"viewNavigation\",\"deleteNavigation\",\"accessModPage\",\"createPage\",\"updatePage\",\"viewPage\",\"deletePage\",\"accessModPost\",\"createPost\",\"updatePost\",\"viewPost\",\"deletePost\",\"accessModCategory\",\"createCategory\",\"updateCategory\",\"viewCategory\",\"deleteCategory\",\"accessModUser\",\"createUser\",\"updateUser\",\"viewUser\",\"deleteUser\",\"createGroupUser\",\"updateGroupUser\",\"viewGroupUser\",\"deleteGroupUser\",\"updateSetting\",\"viewSetting\"]');
INSERT INTO `if_groups` VALUES (2, 'members', 'General User', '[\"createCategory\",\"updateCategory\",\"viewCategory\",\"deleteCategory\",\"accessModUser\",\"createUser\",\"updateUser\",\"viewUser\",\"deleteUser\",\"createGroupUser\",\"updateGroupUser\",\"viewGroupUser\",\"deleteGroupUser\",\"updateSetting\",\"viewSetting\"]');

-- ----------------------------
-- Table structure for if_languages
-- ----------------------------
DROP TABLE IF EXISTS `if_languages`;
CREATE TABLE `if_languages`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `language` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `abbreviation` varchar(3) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `author` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `author_website` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `is_default` enum('0','1') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of if_languages
-- ----------------------------
INSERT INTO `if_languages` VALUES (1, 'english', 'en', 'Tomaz Muraus', 'http://www.open-blog.info', '1');
INSERT INTO `if_languages` VALUES (2, 'slovene', 'sl', 'Tomaz Muraus', 'http://www.open-blog.info', '0');

-- ----------------------------
-- Table structure for if_links
-- ----------------------------
DROP TABLE IF EXISTS `if_links`;
CREATE TABLE `if_links`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `url` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `target` enum('blank','self','parent') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'blank',
  `description` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `visible` enum('yes','no') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'yes',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of if_links
-- ----------------------------
INSERT INTO `if_links` VALUES (1, 'Open Blog', 'http://www.open-blog.info', 'blank', 'Open Blog Website', 'yes');
INSERT INTO `if_links` VALUES (2, 'CodeIgniter', 'http://www.codeigniter.com', 'blank', 'Codeigniter PHP Framework', 'yes');

-- ----------------------------
-- Table structure for if_login_attempts
-- ----------------------------
DROP TABLE IF EXISTS `if_login_attempts`;
CREATE TABLE `if_login_attempts`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `login` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `time` int(11) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for if_nav_groups
-- ----------------------------
DROP TABLE IF EXISTS `if_nav_groups`;
CREATE TABLE `if_nav_groups`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `abbrev` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci COMMENT = 'Navigation groupings. Eg, header, sidebar, footer, etc' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of if_nav_groups
-- ----------------------------
INSERT INTO `if_nav_groups` VALUES (1, 'Header', 'header');
INSERT INTO `if_nav_groups` VALUES (2, 'Sidebar', 'sidebar');
INSERT INTO `if_nav_groups` VALUES (3, 'Footer', 'footer');
INSERT INTO `if_nav_groups` VALUES (4, 'Topbar', 'topbar');

-- ----------------------------
-- Table structure for if_navigation
-- ----------------------------
DROP TABLE IF EXISTS `if_navigation`;
CREATE TABLE `if_navigation`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NULL DEFAULT 0,
  `title` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `url` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `external` enum('0','1') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0',
  `id_groups` int(11) NULL DEFAULT 0,
  `order` int(5) NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of if_navigation
-- ----------------------------
INSERT INTO `if_navigation` VALUES (1, 0, 'Home', 'Index', 'index.php', '0', 1, 1);
INSERT INTO `if_navigation` VALUES (9, 0, 'About Me', 'About Me', 'page/about-me', '0', 2, 1);
INSERT INTO `if_navigation` VALUES (11, 0, 'About Me', 'About Me', 'page/about-me', '0', 1, 2);
INSERT INTO `if_navigation` VALUES (12, 11, 'Term and Condition', 'Term and Condition', 'page/term-and-condition', '0', 1, 1);
INSERT INTO `if_navigation` VALUES (19, 11, 'Product', 'Product', 'page/product', '0', 1, 2);

-- ----------------------------
-- Table structure for if_pages
-- ----------------------------
DROP TABLE IF EXISTS `if_pages`;
CREATE TABLE `if_pages`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `url_title` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `author` int(11) NULL DEFAULT 0,
  `date` datetime(0) NULL DEFAULT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `meta_key` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `meta_desc` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `status` enum('active','inactive') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'active',
  `type` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `default` tinyint(1) NULL DEFAULT 0,
  `image_header` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `create_at` datetime(0) NULL DEFAULT NULL,
  `update_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of if_pages
-- ----------------------------
INSERT INTO `if_pages` VALUES (3, 'Home', 'home', 1, '2020-01-29 07:00:00', 'Homepage', 'home,page', 'Homepage', 'active', '', 1, NULL, '2020-01-28 00:46:19', NULL);
INSERT INTO `if_pages` VALUES (4, 'About Me', 'about-me', 1, '2020-02-03 07:00:00', '<div style=\"color: rgb(187, 187, 187); background-color: rgb(40, 44, 52); font-family: Consolas, \"Courier New\", monospace; line-height: 19px; white-space: pre;\">Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum fugit numquam distinctio, vitae ex aut ab ut qui doloremque molestias totam, expedita delectus nemo repudiandae, cumque quibusdam blanditiis molestiae commodi.</div>', 'about,lorem,ipsu', 'lorem ipsum about page', 'active', '', 0, NULL, '2020-02-03 11:00:48', NULL);
INSERT INTO `if_pages` VALUES (5, 'Term and Condition', 'term-and-condition', 1, '2020-02-03 07:00:00', '<div style=\"color: rgb(187, 187, 187); background-color: rgb(40, 44, 52); font-family: Consolas, \"Courier New\", monospace; line-height: 19px; white-space: pre;\">Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum fugit numquam distinctio, vitae ex aut ab ut qui doloremque molestias totam, expedita delectus nemo repudiandae, cumque quibusdam blanditiis molestiae commodi.</div>', 'term,condition,', 'lorem ipsum term condition', 'active', '', 0, NULL, '2020-02-03 11:01:46', NULL);
INSERT INTO `if_pages` VALUES (6, 'Product', 'product', 1, '2020-02-09 22:31:49', ' ', 'product', 'lorem ipsum', 'active', ' ', 0, NULL, '2020-02-09 22:32:07', NULL);

-- ----------------------------
-- Table structure for if_posts
-- ----------------------------
DROP TABLE IF EXISTS `if_posts`;
CREATE TABLE `if_posts`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author` int(11) NOT NULL DEFAULT 0,
  `date_posted` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `meta_key` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `meta_desc` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `title` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `id_cat` int(11) NOT NULL DEFAULT 0,
  `content_id` int(11) NOT NULL DEFAULT 0,
  `url_title` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `head_article` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `main_article` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `image_header` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `allow_comments` enum('0','1') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '1',
  `sticky` int(1) NOT NULL DEFAULT 0,
  `featured` int(1) NOT NULL DEFAULT 0,
  `status` enum('draft','published') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'published',
  `hit` int(11) NOT NULL DEFAULT 0,
  `create_at` datetime(0) NULL DEFAULT NULL,
  `update_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`, `allow_comments`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of if_posts
-- ----------------------------
INSERT INTO `if_posts` VALUES (1, 1, '2011-03-21 00:00:00', '', '', 'Welcome to My Blog', 0, 0, 'welcome-to-my-blog', '<p>Hello Guest :)</p>\n<p>Selamat datang di blog i-fuk.com. Blog yang  berisikan beberapa  artikel menarik dan mungkin sedikit kisah tentang  saya (wong namanya  juga web personal :p ) yang mungkin BISA menjadi bahan inspirasi atau  mungkin bisa bikin kalian tambah puyeng.. :p</p>', '<p>Ok guys!! langsung aja deh,  explore my blog, read the post, tinggalkan jejak (comment dikit yah.. :)  ) and enjoy... :)</p>', NULL, '1', 1, 0, 'published', 0, NULL, NULL);
INSERT INTO `if_posts` VALUES (3, 1, '2012-05-24 00:00:00', 'blog,bla,bla,bla,bla', 'bla blog bla blog', 'Pekerjaan Tukang Sampah', 2, 5, 'pekerjaan-tukang-sampah', '<p>Siapa sih yang ga kenal ama pekerjaan ini ? pasti semua udah tau donk tukang sampah kerjaanya mungut-mungutin sampah yang ada di jalan atau komplek-komplek rumah kalian. Nah, kali ini saya ingin menjelaskan sedikit tentang pekerjaan ini, walaupun pekerjaan ini rendah tapi bisa dibilang mereka adalah PAHLAWAN KEBERSIHAN lho, ga percaya ? ya udah mending lanjut bacanya aja ya...</p>', '<p><img src=\"http://posterous.com/getfile/files.posterous.com/ganaspati/rPXKTj4OjoC2z3UrXzakjXGQ1gztRHp7AXROdWx8FnkNh2mDepLa4sOgqPd2/54904_tukang_sampah_menyusuri_.jpg\" alt=\"Tukang Sampah\" width=\"200\" height=\"150\" />Tukang sampah, ya...tukang sampah merupakan pekerjaan rendah yang mungkin sebagian orang menilai bahwa pekerjaan ini pekerjaan hina or apa lah yang berkaitan tentang sampah, bau dan jijik...</p>\r\n<p>Hmmm..bisa dibayangkan ya qo mau sih orang-orang itu jadi tukang sampah. Ya mungkin karena faktor ekonomi or susahnya cari pekerjaan di Jakarta, maka mereka rela kerja jadi tukang sampah yang penting bisa hidup di Kota Metropolitan ini.</p>\r\n<p>Pernah ga sih terfikir oleh kalian, pekerjaan tukang sampah itu apa aja sih ? ada ga sih aturan-aturan yang berlaku untuk pekerjaan ini ? Nah...kali ini saya mo ngebahas nih tentang deskripsi pekerjaan dari tukang sampah serta aturan-aturan apa saja sih yang berlaku pada pekerjaan ini.</p>\r\n<p>Tukang sampah menurut deskripsi umum (deksripsi dari sudut pandang orang-orang) merupakan orang atau sekelompok orang yang memilih atau mempunyai kegiatan atau pekerjaan untuk membersihkan lingkungan sekitar dari benda atau barang yang sudah tidak terpakai dan tidak bisa digunakan kembali yang dikategorikan sebagai sampah.</p>\r\n<p>Kita dah tau kan deksripsi dari tukang sampah itu seperti apa, nah untuk detail pekerjaanya sendiri seperti apa sih tukang sampah itu ? Ada tidak sih aturan-aturan yang berlaku pada pekerjaan ini ?? Eit..jangan salah, walaupun pekerjaan ini di anggap sederhana, tetapi pekerjaan tukang smapah ini mempunyai aturan atau <em>Etika</em> yang harus dijalani dan dipatuhi.</p>\r\n<p>Adapun aturan atau Etika dari pekerjaan tukang sampah ini adalah :</p>\r\n<ol>\r\n<li>Harus bertindak jujur.</li>\r\n<li>Pekerjaan dimulai dari pukul 05.00 pagi hingga pukul 09.00.</li>\r\n<li>Pengangkutan sampah dilakukan 1 minggu 2x (ada beberapa diantaranya 1 minggu 3x tergantung dari kebijakan RT serta warga setempat).</li>\r\n<li>Harus mengangkut semua sampah-sampah yang berada pada rute atau wilayah kerja masing-masing dan tidak boleh ada 1 pun yang tertinggal.</li>\r\n<li>Bertanggungjawab pada rute atau wilayah kerja yang telah di tentukan.</li>\r\n<li>Tidak diperbolehkan meminta uang atau pungutan apapun yang bersifat pribadi.</li>\r\n<li>Tidak diperbolehkan mengambil barang-barang atau benda apapun yang tidak ada kaitannya dengan sampah.</li>\r\n</ol>\r\n<p>Kira-kira seperti itulah aturan-aturan yang berlaku bagi para pekerja tukang sampah tersebut. Walaupun tidak tertulis akan tetapi hal ini harus di patuhi kepada setiap pekerja tukang sampah tersebut. Bila ada salah satu hal yang dilanggar ataupun pengaduan dari warga atau seseorang tentang tingkah laku yang kurang baik dari para pekerja tukang sampah tersebut, maka akan diberi sanksi berupa di berhentikan dari pekerjaannya sebagai tukang sampah.</p>\r\n<p><img src=\"http://farm3.static.flickr.com/2557/4042286166_2d145d01b9.jpg\" alt=\"\" width=\"200\" height=\"150\" />Hmm...sungguh berat memang pekerjaan menjadi tukang sampah, walaupun saya tidak pernah melakukan pekerjaan tersebut akan tetapi saya bisa membayangkan alangkah sulitnya mengerjakan pekerjaan tersebut. Membawa gerobak sampah dan keliling-keliling wilayah kerja atau rute yang telah ditentukan dan juga bergelut dengan bau-bau yang tidak sedap. Wah..!! tidak bisa dibayangkan !!!</p>\r\n<p>Sungguh salut saya kepada orang-orang yang mau melakukan pekerjaan tersebut. Mereka juga bisa dibilang sebagai PAHLAWAN KEBERSIHAN. Loh ? kenapa ?? ya coba anda bayangkan, bila tidak ada orang seperti mereka, kita sendiri yang harus membawa sampah-sampah kita ke daerah Tempat Pembuangan Akhir (TPA) atau Tempat Pembuangan Sampah (TPS). Apakah anda mau melakukan hal itu ?? Nah bisa dibayangkan kan, begitu berharganya tukang sampah tersebut. Tanpa mereka lingkungan kita tidak akan bisa bersih dari sampah.</p>', NULL, '1', 0, 0, 'published', 0, NULL, NULL);
INSERT INTO `if_posts` VALUES (4, 1, '2011-04-09 00:00:00', '', '', 'Sanksi Pelanggaran Kode Etik Programmer', 1, 0, 'sanksi-pelanggaran-kode-etik-programmer', '<p><span><img style=\"float: left; margin:5px;\" src=\"http://www.funnycatsite.com/pictures/Programmer_Cat.jpg\" alt=\"Programmer\" width=\"105\" height=\"78\" /></span>Programmer adalah orang yang bekerja membuat atau merancang sebuah system untuk membantu memudahkan pekerjaan manusia yang menggunakan media Komputer. Sekarang ini banyak sekali Programmer-programmer baik freelance maupun yang tidak berlomba membuat sebuah system yang bisa dibilang canggih dan bermanfaat bagi manusia. Benarkah seorang programmer kebal akan hukum apabila melanggar kode Etik programmer ?</p>', '<p>Programmer adalah individu yang bertugas dalam hal rincian implementasi, pengemasan, dan modifikasi algoritma serta struktur data, dituliskan dalam sebuah bahasa pemrograman tertentu.<br />Berikut ini adalah beberapa kode etik yang disadur berdasarkan kode etik yang kini digunakan oleh perkumpulan programmer internasional yang berlaku saat ini :</p>\n<ol>\n<li>Seorang programmer tidak boleh membuat atau mendistribusikan Malware.</li>\n<li>Seorang programmer tidak boleh menulis kode yang sulit diikuti dengan sengaja.</li>\n<li>Seorang programmer tidak boleh menulis dokumentasi yang dengan sengaja untuk membingungkan atau tidak akurat.</li>\n<li>Seorang programmer tidak boleh menggunakan ulang kode dengan hak cipta kecuali telah membeli atau telah meminta izin.</li>\n<li>Tidak boleh mencari keuntungan tambahan dari proyek yang didanai oleh pihak kedua tanpa izin.</li>\n<li>Etika profesi yang berlaku bagi programmer di indonesia. Tidak boleh mencuri software khususnya development tools.</li>\n<li>Tidak boleh menerima dana tambahan dari berbagai pihak eksternal dalam suatu proyek secara bersamaan kecuali mendapatkan izin.</li>\n<li>Tidak boleh menulis kode yang dengan sengaja menjatuhkan kode programmer lain untuk mengambil keuntungan dalam menaikkan status.</li>\n<li>Tidak boleh membeberkan data-data penting karyawan dalam perusahaan.</li>\n<li>Tidak boleh memberitahu masalah keuangan pada pekerja dalam pengembangan suatu proyek.</li>\n<li>Tidak pernah mengambil keuntungan dari pekerjaan orang lain.</li>\n<li>Tidak boleh mempermalukan profesinya.</li>\n<li>Tidak boleh secara asal-asalan menyangkal adanya bug dalam aplikasi.</li>\n<li>Tidak boleh mengenalkan bug yang ada di dalam software yang nantinya programmer akan mendapatkan keuntungan dalam membetulkan bug.</li>\n<li>Terus mengikuti pada perkembangan ilmu komputer.</li>\n</ol>\n<p>Adakah sanksi atau hukuman yang debirkan kepada seorang Programmer bila melanggar sanksi tersebut ? Mungkin sebagian orang menganggap bahwa pekerjaan Programmer adalah pekerjaan yang baik-baik saja. Tentu tidak, ada sebagian Programmer justru menggunakan kemampuannya untuk melakukan tindak kejahatan dan merugikan orang lain.</p>\n<p>Adapun beberapa pelanggaran yang umum dan sering terjadi adalah sebagai berikut :</p>\n<ul>\n<li>Pelanggaran Copyright<br /><br />Pelanggaran ini merupakan pelanggaran dimana seorang programmer menggunakan ulang kode dengan hak cipta orang lain atau perusahaan lain dan menjual atau mengkomersilkan kembali kode tersebut dengan mengatas namakan hak cipta programmer tersebut. Untuk pelanggaran ini seorang programmer bisa diberikan sanksi berupa sanksi Hukum baik hukum pidana atau pun hukum perdata.</li>\n</ul>\n<ul>\n<li>Pembuatan Virus Komputer<br /><br />Pelanggaran ini merupakan pelanggaran dimana seorang programmer dengan sengaja membuat sebuah Program Virus, dan menyebarkannya ke semua komputer di dunia melalui jaringan internet. Untuk kasus ini bisa dibilang cukup sulit, dikarenakan banyak programmer pembuat virus tersebut menginisialkan nama aslinya sehingga sulit untuk melacak keberadaannya. <br /><br />Untuk pelanggaran ini, bisa diberikan sanksi berupa sanksi Hukum bila programmer tersebut terbukti dan tertangkap membuat program virus tersebut.</li>\n</ul>\n<ul>\n<li>Pembuatan Software Cracking<br /><br />Untuk pelanggaran yang satu ini merupakan pelanggaran dimana seorang programmer membuat sebuah Aplikasi yang memungkinkan menjadikan Software berbayar menjadi Free alias Gratis.<br /><br />Untuk pelanggaran ini, bisa diberikan sanksi berupa sanksi Hukum karena melanggar hak cipta dari pengembang software asli.</li>\n</ul>\n<ul>\n<li>Hacking<br /><br />Merupakan pelanggaran yang cukup banyak ditemui sekarang ini. Banyak sekali website-website yang terkena hacking oleh para hacker-hacker dunia. Dan tidak hanya merubah tampilan halaman sebuah website saja, kadang juga beberapa hacker ada yang membuat Server dari hosting website tersebut Down alias Hank dan tidak bisa beroperasi selama beberapa jam atau menit.<br /><br />Untuk pelanggaran tersebut belum ada sanksi yang jelas, dan sedikit sulit untuk menangkap tersangka Hacker tersebut karena menggunakan nama inisial. Untuk di Indonesia sudah ada UU yang menangani masalah tersebut yaitu UU ITE.</li>\n</ul>\n<ul>\n<li>Carding<br /><br />Pelanggaran ini merupakan pelanggaran seorang programmer dimana programmer tersebut mengumpulkan data Kartu Kredit atau Akun Bank dari seseorang dan kemudia disalahgunakan dengan memindahkan sejumlah uang atau menggunakan uang hasil pengumpulan data tersebut.<br /><br />Untuk pelanggaran ini bisa dikenakan Sanksi Hukum dan masuk kedalam kategori Hukum Pidana maupun Perdata bila pelaku tertangkap dan terdapat bukti yang menguatkan.</li>\n</ul>\n<p><br />Itulah beberapa pelanggaran yang sering terjadi pada dunia Programmer. Masih banyak pelanggaran lainnya yang tidak dapat saya sampaikan. Mungkin anda bisa mencarinya di Google.. :)</p>\n<p>&nbsp;</p>\n<p>Download artikel ini : <a title=\"dowload\" href=\"http://www.i-fuk.com/downloads/sanski_dan_etika_programer.pdf\" target=\"_blank\">Sanksi Pelanggaran Kode Etik Programmer</a></p>', NULL, '1', 0, 0, 'published', 0, NULL, NULL);
INSERT INTO `if_posts` VALUES (5, 1, '2011-05-02 00:00:00', '', '', 'Manusia dan Kasih Sayang', 3, 0, 'manusia-dan-kasih-sayang', '<p>Pengertian kasih sayang menurut kamus umum bahasa indonesia karangan W.J.S.Poerwadamlinta adalah perasaan sayang. perasaan cinta atau perasaan suka kepada seseorang.</p>', '<p>Dalam kehidupan berumah tangga kasih sayang merupakan kunci kebahagiaan. Kasih sayang ini merupakan pertumbuhan dari cinta. Percintaan muda-mudi (pria-wanita) bila diakhiri dengan perkawinan, maka didalam berumah tangga keluarga muda itu bukan lagi bercinta-cintaan. tetapi sudah bersifat kasih mengasihi atau saling menumpahkan kasih sayang.<br /><br />Dalam kasih sayang sadar atau tidak sadar dari masing-masing pihak dituntut tanggung jawab, pengorbanan, kejujuran. saling percaya, saling pengertian, saling terbuka, sehingga keduanya merupakan kesatuan yang bulat dan utuh. Bila salah satu unsur kasih sayang hilang, misalnya unsur tanggung jawab, maka retaklah keutuhan rumah tangga itu. Kasih sayang yang tidak disertai kejujuran, terancamlah kebahagiaan rumah tangga itu.<br /><br />Yang dapat merasakan kasih sayang bukan hanya suami atau istri atau anak-anak yang telah dewasa, melainkan sejak bayi kita telah dapat merasakan kasih sayang dari ayah dan ibunya. Bayi dapat mengenal suara atau sentuhan tangan ayah ibunya. Bagaimana sikap ibunya memegang/menggendong telah dikenalnya. Hal ini karena sang bayi telah mempunyai kepribadian.</p>\n<p>Kasih sayang, dasar komunikasi dalam suatu keluarga. Komunikasi antara anak dan orang tua. pada prinsipnya anak terlahir dan terbentuk sebagai hasil curahan kasih sayang orang tuanya. Pengembangan watak anak dan selanjutnya tak boleh lepas dari kasih sayang dan pematian orang tua. Suatu hubungan yang harmonis akan terjadi bila hal itu terjadi secara timbal balik antara orang tua dan anak.<br /><br />Suatu kasus yang sering teIjadi, yang menyebabkan seseorang menjadi mortinis, keberandalan remaja, frustasi dan sebaginya, dimana semuanya dilatar belakangi kurangnya pematian dan kasih sayang dalam kehidupan keluarganya.<br /><br />Adanya kasih sayang ini mempengaruhi kehidupan si anak dalam masyarakat. Orang tua dalam memberikan kasih sayangnya bennacam-macam demikian pula sebaliknya. Dari cara pemberian cinta kasih ini dapat dibedakan :</p>\n<ol>\n<li><strong>Orang tua bersifat aktif, si anak bersifat pasif.</strong><br />Dalam hal ini orang tua memberikan kasih sayang terhadap anaknya baik berupa moral-materiil dengan sebanyak-banyaknya, dan si anak menerima saja, mengiyakan, tanpa memberikan respon. Hal ini menyebabkan si anak menjadi takut, kurang berani dalam masyarakat, tidak berani menyatakan pendapat, minder, sehingga si anak tidak mampu berdiri sendiri di dalam masyarakat.</li>\n<li><strong>Orang tua bcrsifat pasif, si anak bersifat aktif.</strong><br />Dalam hal ini si anak berlebih-Iebihan memberikan kasih sayang terhadap orang tuanya, kasih sayang ini diberikan secara sepihak, orang tua mendiamkan saja tingkah laku si anak, tidak memberikan perhatian apa yang dipemuat si anak.</li>\n<li><strong>Orang tua bersifat pasif, si anak bersifat pasif.</strong><br />Di sini jelas bahwa masing-masing membawa hidupnya, tingkah lakunya sendiri-sendiri, tanpa saling memperhatikan. Kehidupan keluarga sangat dingin, tidak ada kasih sayang, masing-masing membawa caranya sendiri, tidak ada tegur sapa jika tidak perlu, orang tua hanya memenuhi dalam bidang materi saja.</li>\n<li><strong>Orang tua bersifat aktif, si anak bersifat aktif</strong>.<br />Dalam hal ini orang tua dan anak saling memberikan kasih sayang dengan sebanyak-banyaknya. Sehingga hubungan antara orang tua dan anak sangat intim dan mesra, saling mencintai, saling menghargai, saling membutuhkan.</li>\n</ol>\n<p><br />Kasih sayang itu nampak sekali bila seorang ibu sedang menyusui atau menggendong, bayinya itu diajak bercakap-cakap, ditimang-timang, dinyanyikan, meskipun bayi itu tak tabu arti kata-kata, lagu dan sebagainya.</p>', NULL, '1', 0, 1, 'published', 0, NULL, NULL);
INSERT INTO `if_posts` VALUES (6, 1, '2011-05-03 00:00:00', '', '', 'Manusia dan Cinta', 4, 0, 'manusia-dan-cinta', '<p>Cinta adalah rasa sangat suka (kepada) atau (rasa) sayang (kepada). ataupun (rasa) sangat kasih atau<br />sangat tertarik hatinya.</p>', '<p>Cinta memegang peranan yang penting dalam kehidupan manusia. sebab cinta merupakan landasan dalam kehidupan perkawinan, pembentukan keluarga dan pemeliharaan anak, hubungan yang erat dimasyarakat dan hubungan manusiawi yang akrab. Demikian pula cinta adalah pengikat yang kokoh antara manusia dengan Tuhannya sehingga manusia menyembah Tuhan dengan ikhlas, mengikuti perintah-Nya, dan berpegang teguh pada syariat-Nya.</p>\n<p>Cinta kepada sesama adalah perasaan simpati yang melibatkan emosi yang mendalam Menurut Erich Fromm, ada empat syarat untuk mewujudkan cinta kasih, yaitu:</p>\n<ol>\n<li>Knowledge (pengenalan)</li>\n<li>Responsibilty (tanggung jawab)</li>\n<li>Care (perhatian)</li>\n<li>Respect (saling menghormati)</li>\n</ol>\n<p>Cinta berada di seluruh semua kebudayaan manusia. Oleh karena perbedaan kebudayaan ini, maka pendefinisian dari cinta pun sulit ditetapkan. Para pakar telah mendefinisikan dan memilah-milah istilah ini yang pengertiannya sangat rumit. Antara lain mereka membedakan cinta terhadap sesama manusia dan yang terkait dengannya menkadi:</p>\n<ol>\n<li>Cinta terhadap keluarga</li>\n<li>Cinta terhadap teman-teman, atau philia</li>\n<li>Cinta yang romantis atau juga disebut asmara</li>\n<li>Cinta yang hanya merupakan hawa nafsu atau cinta eros</li>\n<li>Cinta sesama atau juga disebut kasih sayang atau agape</li>\n<li>Cinta dirinya sendiri, yang disebut narsisme</li>\n<li>Cinta akan sebuah konsep tertentu</li>\n<li>Cinta akan negaranya atau patriotisme</li>\n<li>Cinta akan bangsa atau nasionalisme</li>\n</ol>\n<p>&nbsp;</p>', NULL, '1', 0, 1, 'published', 0, NULL, NULL);
INSERT INTO `if_posts` VALUES (7, 1, '2011-05-04 00:00:00', '', '', 'Wujud dan perilaku Manusia akan Keindahan Alam', 5, 0, 'wujud-dan-perilaku-manusia-akan-keindahan-alam', '<p>Keindahan diartikan sebagai keadaan yang enak dipandang, cantik, bagus  benar atau elok. Keindahan juga dapat memberikan kita rasa keingintahuan  tentang hal tersebut semakin terus bertambah. Alam sudah menciptakan  pepohonan dengan keindahan tersendiri. Namun manusia juga bisa  menambahkan keindahan dengan cara merawat alam(pepohonan) dengan baik  sehingga alam juga akan terasa lebih indah.</p>', '<p>Menikmati keindahan alam bisa dengan berbagai cara, contohnya alam yang ada di daerah bali, Pulau Bali sudah  dikenal diseluruh dunia dengan keindahan yang tidak ada bandingannya.  Keindahan alam dan kekayaan adat istiadatnya menjadi salah satu daya  tarik bagi para tour di bali jalanjalan mengunjungi obyek-obyek. Mulai  dari obyek wisata alam, wisata seni dan budaya, sampai dengan atraksi  wisata semua ada di Bali. Untuk dapat menikmati semua keindahan yang  ditawarkan oleh pulau Bali Misalnya ke pulau dewata (Bali). Mereka hanya  ingin melihat dan merasakan keindahan alam bali dengan pantai yang  indah, pasir putih yang masih elok, dan ombak yang ideal.</p>\n<p><br /><span style=\"font-size: medium;\"><strong>CINTA AKAN LINGKUNGAN<br /></strong></span>Lingkungan yang bersih sangat mempengaruhi setiap kehidupan manusia.  Jika lingkungan disekitar itu bersih dan sehat maka kita juga akan  merasa sehat dan nyaman. Sebaliknya jika lingkungan disekeliling kita  kotor maka kita juga akan merasa tidak sehat. Oleh karena itu kita harus  menjaga agar lingkungan disekitar kita bersih .</p>\n<p>Caranya dengan menanam pohon atau tumbuh-tumbuhan apa saja disekitar  halaman rumah. Tanaman itu sangat bagus untuk kehidupan manusia, karena  tanaman akan mengeluarkan oksigen yang sangat dibutuhkan oleh manusia.  Contohnya, jika kita berada dibawah pohon maka kita akan merasa sejuk.  Itu karena pohon megeluarkan oksigen yang akan kita butuhkan. Jadi  kesimpulannya kita harus banyak menanam tanaman dan harus selalu  merawatnya.</p>\n<p>Bukan hanya dengan banyak menanam pohon saja, kita juga harus membuat  lingkungan disekitar kita bersih. Contoh lingkungan kotor juga dapat  berasal dari air. Selama ini kita tenang-tenang saja mencuci pakaian  dengan diterjen. Selain praktis dan mudah didapat, hasilnya pun  memuaskan. Namun, pilihan itu diam-diam membawa dampak lingkungan.  Seperti diketahui, deterjen merupakan produk sintesis. Penggunaannya  akan menimbulkan polusi berupa peningkatan pH air. Kalau keasaman air  tinggi, kehidupan organisme di dalamnya dapat terganggu. Semakin tinggi  penggunaan pembersih sintesis ini di masyarakat luas, tentunya  lingkungan perairan disekitar pemukiman penduduk akan makin tercemar,  termasuk sungai-sungai yang menjadi sumber air baku bagi perusahaan air  minum.</p>\n<p>Lalu, apa yang bisa kita lakukan agar bisa mencuci tanpa rasa  bersalah?Banyak hal yang bisa dilakukan. Misalnya memakai sabun colek  untuk mencuci, selain tidak merusak tangan, sabun colek tidak mengganggu  lingkungan. Selain semua cara-cara yang efektif yang disebutkan tadi,  untuk membuat lingkungan disekitar kita bersih dan sehat kita juga harus  mencintai alam dan lingkungan kita. Kita harus tau bagaimana cara  merawat tanaman dengan baik supaya tanaman itu tumbuh subur dan dapat  menambah penghijauan.</p>', NULL, '1', 0, 0, 'published', 0, NULL, NULL);
INSERT INTO `if_posts` VALUES (8, 1, '2011-05-05 00:00:00', '', '', 'Manusia dan Penderitaan', 2, 0, 'manusia-dan-penderitaan', '<p>Penderitaan adalah sebuah kata yang sangat dijauhi dan paling tidak disenangi oleh siapapun. Berbicara tentang penderitaan ternyata penderitaan tersebut berasal dari dalam dan luar diri manusia. Biasanya orang menyebut dengan factor internal dan faktor eksternal.</p>', '<p>Dalam diri manusia itu ada cipta, rasa dan karysa. Karsa adalah sumber  yang menjadi penggerak segala aktivitas manusia. Cipta adalah realisasi  dari adanya karsa dan rasa. Baik karsa maupun rasa selalu ingin  dipuaskan. Karena selalu ingin dilayani, sedangkan rasa selalu ingin  dipenuhi tuntutannya. Baru dalam keduanya menemukan yang dicarinya atau  diharapkan manusia akan merasa senang, merasa bahagia.<br /> <br /> Apabila karsa dan rasa tidak terpenuhi apa yang dimaksudkan, manusia  akan mendata rasa kurang mengakibatkan munculnya wujud penderitaan,  bahkan lebih dari itu, yaitu rasa takut.<br /> <br /> Rasa takut itu justru sudah menyelinap dan dating menyerang kita sebelum  bencana atau bahaya itu dating menyerangnya. Sekarang yang paling  penting adalah bagaimana upaya kita meniadakan rasa kurang dan rasa  takut itu. Karena kedua rasa itu termasuk penyakit batin masuia, maka  usaha terbaik ialah menyehatkan bathin itu sendiri, rasa kurang itu  muncul dikarenakan adanya anggapan lebih pada pihak lain.<br /> <br /> Kita sudah tahu bahwa factor &ndash; factor yang mempengaruhi penderitaan itu  adalah factor internal dan faktor eksternal. Eksternal datangnya dari  luar diri manusia. Factor ini dapat dibedakan atas dua macam ; yaitu  eksternal murni dan tak murni. Eksternal murni adalah penyebab yang  benar &ndash; benar berasal dari luar diri manusia yang bersangkutan.  Penderitaan itu tidak bukan merupakan akibat ulah manusia yang  bersangkutan.</p>', NULL, '0', 0, 0, 'published', 0, NULL, NULL);
INSERT INTO `if_posts` VALUES (9, 1, '2011-05-09 00:00:00', '', '', 'Manusia dan Tanggung Jawab', 1, 0, 'manusia-dan-tanggung-jawab', '<p>Tanggung jawab menurut kamus umum Bahasa Indonesia adalah, keadaan wajib menanggung segala sesuatunya atau berkewajiban menanggung, memikul jawab, menanggung segala sesuatunya, atau memberikan jawab dan menanggung akibatnya.</p>', '<p><span style=\"font-size: medium;\"><strong>MACAM-MACAM TANGGUNG JAWAB</strong></span><br />Manusia itu berjuang memenuhi keperluannya sendiri atau untuk keperluan pihak lain. Untuk itu ia manghadapi manusia lain dalam masyarakat atau menghadapi lingkungan alam. Dalam usahanya itu manusia juga menyadari bahwa ada kekuatan lain yang ikut menentukan yaitu kekuasaan Tuhan. Dengan demikian tanggung jawab itu dapat dibedakan menurut keadaan manusia atau hubungan yang dibuatnya. Atas dasar ini, lalu dikenal beberapa jenis tanggung jawab. yaitu :</p>\n<ol>\n<li><strong>Tanggung jawab terhadap diri sendiri</strong><br />Tanggug jawab terhadap diri sendiri menuntut kesadaran setiap orang untuk memenuhi kewajibannya sendiri dalam mengembangkan kepribadian sebagai manusia pribadi. Dengan demikian bisa menyelesaikan masalah-masalah kemanusiaan mengenai dirinya sendiri Menurut sifat dasarnya manusia adalah mahluk bernlOral, tetapi manusia juga seorang pribadi. Karena merupakan seorang pribadi maka manusia mempunyai pendapat sendiri. perasaan sendiri, angan-angan sendiri. Sebagai perwujudan dari pendapat:, perasaan dan angan-angan itu manusia berbuat dan bertindak. Dalam hal ini manusia tidak luput dari kesalahan, kekeliruan, baik yang disengaja maupun tidak.</li>\n<li><strong>Tanggung jawab terhadap keluarga</strong><br />Keluarga merupakan masyarakat keeil. Keluarga terdiri dari suami-istri, ayah-ibu dan anak-anak. dan juga orang lain yang menjadi anggota keluarga. Tiap anggota keluarga wajib bertanggung jawab kepada keluarganya. Tanggung jawab ini menyangkut nama baik keluarga. Tetapi tanggung jawab juga merupakan kesejahteraan, keselamatan, pendidikan. dan kehidupan. </li>\n<li><strong>Tanggung jawab terhadap Masyarakat</strong> <br />Pada hakekatnya manusia tidak bisa hidup tanpa bantuan manusia lain, sesuai dengan kedudukannya sebagai mahluk sosial. Karena membutuhkan manusia lain maka ia harns berkomunikasi dengan manusia lain tersebut. Sehingga dengan demikian manusia di sini merupakan anggota masyarakat yang tentunya mempunyai tanggung jawab seperti anggota masyarakat yang lain agar dapat melangsungkan hidupnya dalam masyarakat tersebut. Wajarlah apabila segala tingkah laku dan perbuatannya harns dipertanggung jawabkan kepada masyarakat.</li>\n<li><strong>Tanggung jawab kepada Bangsa / Negara</strong><br />Suatu kenyataan lagi, bahwa tiap manusia, tiap individu adalah warga negara suatu negara. Dalam berpikir, berbuat, bertindak, bertingkah laku manusia terikat oleh norma-norma atau ukuran-ukuran yang dibuat oleh negara. Manusia tidak dapat berbuat semaunya sendiri. Bila perbuatan manusia itu salah, maka ia hams bertanggung jawab kepada negara.</li>\n<li><strong>Tanggung jawab terhadap Tuhan</strong><br />Tuhan menciptakan manusia di bumi ini bukanlah tanpa tanggung jawab, melainkan untuk mengisi kehidupannya manusia mempunyai tanggung jawab langsung temadap Tuhan. Sehingga tindakan manusia tidak bisa lepas dari hukuman-hukuman Tuhan yang dituangkan dalam berbagai kitab suci melalui berbagai macam agama. Pelanggaran dari hukuman-hukuman tersebut akan segera diperingatkan oleh Tuhan dan jika dengan peringatan yang keraspun manusia masih juga tidak menghiraukan maka Tuhan akan melakukan kutukan. Sebab dengan mengabaikan perintah-perintah Tuhan berarti mereka meninggalkan tanggung jawab yang seharusnya dilakukan manusia temadap Tuhan sebagai penciptanya, bahkan untuk memenuhi tanggung jawabnya, manusia perlu pengorbanan.</li>\n</ol>', NULL, '1', 0, 0, 'published', 0, NULL, NULL);
INSERT INTO `if_posts` VALUES (14, 1, '2020-01-28 15:13:00', 'php,cms,tags,posting,image', 'Testing post with image', 'Testing Post with Image', 1, 0, 'testing-post-with-image', 'Testing post with image', 'Testing post with image', NULL, '', 0, 0, 'published', 0, NULL, NULL);
INSERT INTO `if_posts` VALUES (15, 1, '2020-01-28 16:00:00', 'testing,image,post', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ut tempus turpis, ac malesuada quam. Vestibulum in eros semper leo feugiat fringilla. Fusce quis consequat enim. Duis volutpat, lorem id imperdiet pharetra, leo lorem pretium elit, id malesuada nisl mauris quis ex.', 'Testing Post lagi pake image', 1, 0, 'testing-post-lagi-pake-image', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ut tempus turpis, ac malesuada quam. Vestibulum in eros semper leo feugiat fringilla. Fusce quis consequat enim. Duis volutpat, lorem id imperdiet pharetra, leo lorem pretium elit, id malesuada nisl mauris quis ex.', '<span style=\"color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; text-align: justify;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ut tempus turpis, ac malesuada quam. Vestibulum in eros semper leo feugiat fringilla. Fusce quis consequat enim. Duis volutpat, lorem id imperdiet pharetra, leo lorem pretium elit, id malesuada nisl mauris quis ex. Praesent eu metus placerat, fringilla nunc sed, auctor augue. Curabitur in lacus in nisi efficitur aliquam ut ut ex. Aliquam volutpat sem massa, sed sagittis lacus lobortis in. Etiam tristique nisl eu neque consectetur, vitae maximus lorem sollicitudin. Donec convallis bibendum ligula gravida varius. Vivamus sed ullamcorper risus, ut posuere odio. Suspendisse hendrerit mattis nulla vel varius. Nulla lobortis est et urna lobortis congue. Phasellus rhoncus auctor egestas.</span>', NULL, '1', 0, 0, 'published', 0, NULL, NULL);
INSERT INTO `if_posts` VALUES (16, 1, '2020-01-28 15:33:00', 'testing,post,cms,new,php', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ut tempus turpis, ac malesuada quam. Vestibulum in eros semper leo feugiat fringilla.', 'Testing Post Awal CMS IfCodeBlog', 2, 0, 'testing-post-awal-cms-ifcodeblog', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ut tempus turpis, ac malesuada quam. Vestibulum in eros semper leo feugiat fringilla.', '<span style=\"color: rgb(0, 0, 0); font-family: \" open=\"\" sans\",=\"\" arial,=\"\" sans-serif;=\"\" text-align:=\"\" justify;\"=\"\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ut tempus turpis, ac malesuada quam. Vestibulum in eros semper leo feugiat fringilla. Fusce quis consequat enim. Duis volutpat, lorem id imperdiet pharetra, leo lorem pretium elit, id malesuada nisl mauris quis ex. Praesent eu metus placerat, fringilla nunc sed, auctor augue. Curabitur in lacus in nisi efficitur aliquam ut ut ex. Aliquam volutpat sem massa, sed sagittis lacus lobortis in. Etiam tristique nisl eu neque consectetur, vitae maximus lorem sollicitudin. Donec convallis bibendum ligula gravida varius. Vivamus sed ullamcorper risus, ut posuere odio. Suspendisse hendrerit mattis nulla vel varius. Nulla lobortis est et urna lobortis congue. Phasellus rhoncus auctor egestas.</span>', 'upload/post/hakteknas_bali.jpg', '', 0, 0, 'published', 0, NULL, '2020-01-27 22:44:27');

-- ----------------------------
-- Table structure for if_posts_to_categories
-- ----------------------------
DROP TABLE IF EXISTS `if_posts_to_categories`;
CREATE TABLE `if_posts_to_categories`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of if_posts_to_categories
-- ----------------------------
INSERT INTO `if_posts_to_categories` VALUES (1, 1, 1);

-- ----------------------------
-- Table structure for if_settings
-- ----------------------------
DROP TABLE IF EXISTS `if_settings`;
CREATE TABLE `if_settings`  (
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `value` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`name`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of if_settings
-- ----------------------------
INSERT INTO `if_settings` VALUES ('admin_email', 'admin@gmail.com');
INSERT INTO `if_settings` VALUES ('allow_registrations', '0');
INSERT INTO `if_settings` VALUES ('contact_email', ' support@gmail.com');
INSERT INTO `if_settings` VALUES ('email_protocal', 'sendmail');
INSERT INTO `if_settings` VALUES ('enable_atom_comments', '1');
INSERT INTO `if_settings` VALUES ('enable_atom_posts', '1');
INSERT INTO `if_settings` VALUES ('enable_captcha', '0');
INSERT INTO `if_settings` VALUES ('enable_delicious', '0');
INSERT INTO `if_settings` VALUES ('enable_digg', '0');
INSERT INTO `if_settings` VALUES ('enable_furl', '0');
INSERT INTO `if_settings` VALUES ('enable_reddit', '0');
INSERT INTO `if_settings` VALUES ('enable_rss_comments', '1');
INSERT INTO `if_settings` VALUES ('enable_rss_posts', '1');
INSERT INTO `if_settings` VALUES ('enable_stumbleupon', '0');
INSERT INTO `if_settings` VALUES ('enable_technorati', '0');
INSERT INTO `if_settings` VALUES ('links_per_box', '5');
INSERT INTO `if_settings` VALUES ('meta_keywords', 'cms,simpla,ci,codeigniter,code,hml,css,cms blog,openblog');
INSERT INTO `if_settings` VALUES ('months_per_archive', '5');
INSERT INTO `if_settings` VALUES ('offline_reason', 'scriptnya blom jadi..hahahahahah...hihihihihihih...heheheheh');
INSERT INTO `if_settings` VALUES ('og_image', 'icon.png');
INSERT INTO `if_settings` VALUES ('posts_per_page', '5');
INSERT INTO `if_settings` VALUES ('recognize_user_agent', '1');
INSERT INTO `if_settings` VALUES ('sendmail_path', ' /path/to/path');
INSERT INTO `if_settings` VALUES ('site_description', 'Simpla CMS is just simple CMS for Blog like wordpress but still different.');
INSERT INTO `if_settings` VALUES ('site_enabled', '1');
INSERT INTO `if_settings` VALUES ('site_logo', 'logo_ifcode_color.png');
INSERT INTO `if_settings` VALUES ('site_title', 'If-Blog');
INSERT INTO `if_settings` VALUES ('smtp_host', '');
INSERT INTO `if_settings` VALUES ('smtp_pass', ' ');
INSERT INTO `if_settings` VALUES ('smtp_port', ' ');
INSERT INTO `if_settings` VALUES ('smtp_user', ' ');
INSERT INTO `if_settings` VALUES ('system_email', 'noreply@gmail.com');

-- ----------------------------
-- Table structure for if_sidebar
-- ----------------------------
DROP TABLE IF EXISTS `if_sidebar`;
CREATE TABLE `if_sidebar`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `file` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `status` enum('enabled','disabled') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of if_sidebar
-- ----------------------------
INSERT INTO `if_sidebar` VALUES (1, 'Search', 'search', 'enabled', 1);
INSERT INTO `if_sidebar` VALUES (2, 'Archive', 'archive', 'enabled', 2);
INSERT INTO `if_sidebar` VALUES (3, 'Categories', 'categories', 'enabled', 3);
INSERT INTO `if_sidebar` VALUES (4, 'Tag_cloud', 'tag_cloud', 'enabled', 4);
INSERT INTO `if_sidebar` VALUES (5, 'Feeds', 'feeds', 'enabled', 5);
INSERT INTO `if_sidebar` VALUES (6, 'Links', 'links', 'enabled', 6);
INSERT INTO `if_sidebar` VALUES (7, 'Other', 'other', 'enabled', 7);

-- ----------------------------
-- Table structure for if_social_link
-- ----------------------------
DROP TABLE IF EXISTS `if_social_link`;
CREATE TABLE `if_social_link`  (
  `social_id` int(11) NOT NULL,
  `social_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `social_url` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `active` int(11) NULL DEFAULT NULL,
  `icon` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `timestamp_update` datetime(0) NULL DEFAULT NULL
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of if_social_link
-- ----------------------------
INSERT INTO `if_social_link` VALUES (1, 'twitter', 'aaaaaaaaaaaaaaaa', 1, 'fab fa-twitter', '2020-02-03 09:04:36');
INSERT INTO `if_social_link` VALUES (2, 'facebook', 'aaaaaaaaaaaaaaa', 1, 'fab fa-facebook-f', '2020-02-03 09:04:36');
INSERT INTO `if_social_link` VALUES (3, 'linkedin', 'aaaaaaaaaaaaaaa', 1, 'fab fa-linkedin', '2020-02-03 09:04:36');
INSERT INTO `if_social_link` VALUES (4, 'youtube', 'aaaaaaaaaaaaa', 1, 'fab fa-youtube', '2020-02-03 09:04:36');
INSERT INTO `if_social_link` VALUES (5, 'google', 'bbbbbbbbbbbbbb', 1, 'fab fa-google', '2020-02-03 09:04:36');
INSERT INTO `if_social_link` VALUES (6, 'pinterest', '', 0, 'fab fa-pinterest', '2020-02-02 14:05:03');
INSERT INTO `if_social_link` VALUES (7, 'foursquare', '', 0, 'fab fa-foursquare', '2020-02-02 14:05:03');
INSERT INTO `if_social_link` VALUES (8, 'myspace', '', 0, 'fa fa-link', '2020-02-02 14:05:03');
INSERT INTO `if_social_link` VALUES (9, 'soundcloud', '', 0, 'fab fa-soundcloud', '2020-02-02 14:05:03');
INSERT INTO `if_social_link` VALUES (10, 'spotify', '', 0, 'fab fa-spotify', '2020-02-02 14:05:03');
INSERT INTO `if_social_link` VALUES (11, 'lastfm', '', 0, 'fab fa-lastfm', '2020-02-02 14:05:03');
INSERT INTO `if_social_link` VALUES (12, 'vimeo', '', 0, 'fab fa-vimeo-v', '2020-02-02 14:05:03');
INSERT INTO `if_social_link` VALUES (13, 'dailymotion', '', 0, 'fa fa-link', '2020-02-02 14:05:03');
INSERT INTO `if_social_link` VALUES (14, 'vine', '', 0, 'fab fa-vine', '2020-02-02 14:05:03');
INSERT INTO `if_social_link` VALUES (15, 'flickr', '', 0, 'fab fa-flickr', '2020-02-02 14:05:03');
INSERT INTO `if_social_link` VALUES (16, 'instagram', 'aaaaaaaaaaaaaaaaaaaaa', 1, 'fab fa-instagram', '2020-02-03 09:04:36');
INSERT INTO `if_social_link` VALUES (17, 'tumblr', '', 0, 'fab fa-tumblr', '2020-02-02 14:05:03');
INSERT INTO `if_social_link` VALUES (18, 'reddit', '', 0, 'fab fa-reddit', '2020-02-02 14:05:03');
INSERT INTO `if_social_link` VALUES (19, 'envato', '', 0, 'fa fa-link', '2020-02-02 14:05:03');
INSERT INTO `if_social_link` VALUES (20, 'github', '', 0, 'fab fa-github', '2020-02-02 14:05:03');
INSERT INTO `if_social_link` VALUES (21, 'tripadvisor', '', 0, 'fab fa-tripadvisor', '2020-02-02 14:05:03');
INSERT INTO `if_social_link` VALUES (22, 'stackoverflow', '', 0, 'fab fa-stack-overflow', '2020-02-02 14:05:03');
INSERT INTO `if_social_link` VALUES (23, 'persona', '', 0, 'fa fa-link', '2020-02-02 14:05:03');
INSERT INTO `if_social_link` VALUES (24, 'odnoklassniki', '', 0, 'fab fa-odnoklassniki', '2020-02-02 14:05:03');
INSERT INTO `if_social_link` VALUES (25, 'vk', '', 0, 'fab fa-vk', '2020-02-02 14:05:03');
INSERT INTO `if_social_link` VALUES (26, 'gitlab', '', 0, 'fab fa-gitlab', '2020-02-02 14:05:03');

-- ----------------------------
-- Table structure for if_tags
-- ----------------------------
DROP TABLE IF EXISTS `if_tags`;
CREATE TABLE `if_tags`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of if_tags
-- ----------------------------
INSERT INTO `if_tags` VALUES (1, 'codeigniter');
INSERT INTO `if_tags` VALUES (2, 'blog');
INSERT INTO `if_tags` VALUES (3, 'php');
INSERT INTO `if_tags` VALUES (4, 'cms');

-- ----------------------------
-- Table structure for if_tags_to_posts
-- ----------------------------
DROP TABLE IF EXISTS `if_tags_to_posts`;
CREATE TABLE `if_tags_to_posts`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tag_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 27 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of if_tags_to_posts
-- ----------------------------
INSERT INTO `if_tags_to_posts` VALUES (1, 1, 1);
INSERT INTO `if_tags_to_posts` VALUES (2, 2, 1);
INSERT INTO `if_tags_to_posts` VALUES (7, 3, 12);
INSERT INTO `if_tags_to_posts` VALUES (8, 4, 12);
INSERT INTO `if_tags_to_posts` VALUES (11, 3, 14);
INSERT INTO `if_tags_to_posts` VALUES (12, 4, 14);
INSERT INTO `if_tags_to_posts` VALUES (13, 3, 15);
INSERT INTO `if_tags_to_posts` VALUES (14, 4, 15);
INSERT INTO `if_tags_to_posts` VALUES (15, 3, 16);
INSERT INTO `if_tags_to_posts` VALUES (16, 4, 16);
INSERT INTO `if_tags_to_posts` VALUES (19, 3, 18);
INSERT INTO `if_tags_to_posts` VALUES (20, 4, 18);
INSERT INTO `if_tags_to_posts` VALUES (21, 3, 1);
INSERT INTO `if_tags_to_posts` VALUES (22, 4, 1);
INSERT INTO `if_tags_to_posts` VALUES (23, 3, 1);
INSERT INTO `if_tags_to_posts` VALUES (24, 4, 1);
INSERT INTO `if_tags_to_posts` VALUES (25, 3, 1);
INSERT INTO `if_tags_to_posts` VALUES (26, 4, 1);

-- ----------------------------
-- Table structure for if_templates
-- ----------------------------
DROP TABLE IF EXISTS `if_templates`;
CREATE TABLE `if_templates`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `author` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `path` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `image` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `is_active` enum('0','1') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '1',
  `is_admin` tinyint(4) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of if_templates
-- ----------------------------
INSERT INTO `if_templates` VALUES (1, 'IfBlog', 'ifthenuk', 'default', 'ifblog.jpg', '1', 0);
INSERT INTO `if_templates` VALUES (2, 'Beautiful Day', 'Arcsin', 'beautiful_day', 'beautiful_day.jpg', '0', 0);
INSERT INTO `if_templates` VALUES (3, 'Bootadmin', 'bootadmin.net', 'admin', 'bootadmin.jpg', '1', 1);

-- ----------------------------
-- Table structure for if_users
-- ----------------------------
DROP TABLE IF EXISTS `if_users`;
CREATE TABLE `if_users`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `username` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(254) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `activation_selector` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `activation_code` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `forgotten_password_selector` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `forgotten_password_code` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED NULL DEFAULT NULL,
  `remember_selector` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `remember_code` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED NULL DEFAULT NULL,
  `active` tinyint(1) UNSIGNED NULL DEFAULT NULL,
  `first_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `last_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `company` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `phone` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `uc_email`(`email`) USING BTREE,
  UNIQUE INDEX `uc_activation_selector`(`activation_selector`) USING BTREE,
  UNIQUE INDEX `uc_forgotten_password_selector`(`forgotten_password_selector`) USING BTREE,
  UNIQUE INDEX `uc_remember_selector`(`remember_selector`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of if_users
-- ----------------------------
INSERT INTO `if_users` VALUES (1, '127.0.0.1', 'administrator', '$2y$12$rem44wTGGGoeTqiXrU6o1e.6FVYzZb8AmrxC2qOxLT0bhk4p2vHGa', 'admin@admin.com', NULL, '', NULL, NULL, NULL, NULL, NULL, 1268889823, 1581303767, 1, 'Admin', 'istrator', 'ADMIN', '0');

-- ----------------------------
-- Table structure for if_users_groups
-- ----------------------------
DROP TABLE IF EXISTS `if_users_groups`;
CREATE TABLE `if_users_groups`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `uc_users_groups`(`user_id`, `group_id`) USING BTREE,
  INDEX `fk_users_groups_users1_idx`(`user_id`) USING BTREE,
  INDEX `fk_users_groups_groups1_idx`(`group_id`) USING BTREE,
  CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `if_groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `if_users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of if_users_groups
-- ----------------------------
INSERT INTO `if_users_groups` VALUES (1, 1, 1);

SET FOREIGN_KEY_CHECKS = 1;
