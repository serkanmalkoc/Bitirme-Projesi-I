-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 30 Eki 2024, 12:05:40
-- Sunucu sürümü: 8.3.0
-- PHP Sürümü: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `sinema`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `filmler`
--

CREATE TABLE `filmler` (
  `id` int NOT NULL,
  `baslik` varchar(255) NOT NULL,
  `yonetmen` varchar(255) NOT NULL,
  `yil` int NOT NULL,
  `tur` varchar(100) NOT NULL,
  `afis` varchar(255) NOT NULL,
  `eklenme_tarihi` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `aciklama` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Tablo döküm verisi `filmler`
--

INSERT INTO `filmler` (`id`, `baslik`, `yonetmen`, `yil`, `tur`, `afis`, `eklenme_tarihi`, `aciklama`) VALUES
(1, 'İnception', 'Christopher Nolan', 2010, 'Bilim Kurgu, Aksiyon', 'afisler/inception-0-1000-0-1500-crop.jpg', '2024-10-23 10:38:21', 'Zihniniz suç mahallidir.\r\nHedeflerinin bilinçaltına sızarak şirket casusluğu yapan yetenekli bir hırsız olan Cobb\'a, imkansız olduğu düşünülen bir görevin bedeli olarak eski hayatını geri kazanma şansı sunulur: “Başlangıç”, başka bir kişinin fikrinin bir hedefin bilinçaltına yerleştirilmesi.'),
(2, 'Blade Runner', 'Ridley Scott', 1982, 'Bilim Kurgu, Gerilim, Drama', 'afisler/vfzE3pjE5G7G7kcZWrA3fnbZo7V-0-1000-0-1500-crop.jpg', '2024-10-23 10:48:57', 'İnsanoğlu eşini buldu... şimdi bu onun sorunu.\r\n2019un dumanlı distopik Los Angelesında, bıçak koşucusu Rick Deckard, kısa ömürlerini uzatmanın bir yolunu bulmak için yaratıcılarını arayan ve Dünyaya kaçan bir dörtlü replikantı yok etmek için emekliliğinden çağrılır.'),
(3, 'Apocalypse Now', 'Francis Ford Coppola', 1979, 'Drama, Savaş', 'afisler/2690-apocalypse-now-0-1000-0-1500-crop.jpg', '2024-10-23 11:05:10', 'This is the end...\r\n\r\nYüzbaşı Benjamin Willard, Vietnam Savaşı\'nın en şiddetli günlerinde, resmi olarak “var olmayan ve hiçbir zaman da var olmayacak” tehlikeli bir göreve gönderilir. Amacı, kişisel ordusunu düşman topraklarında yasadışı gerilla görevlerine götüren Walter Kurtz adlı gizemli bir Yeşil Bereli Albay\'ın yerini tespit etmek ve onu ortadan kaldırmaktır.'),
(4, 'Fight Club', 'David Fincher', 1999, 'Drama', 'afisler/51568-fight-club-0-1000-0-1500-crop.jpg', '2024-10-24 19:47:28', 'Yaramazlık. Kargaşa. Sabun. Zaman ayarlı bir uykusuzluk hastası ve kaypak bir sabun satıcısı, ilkel erkek saldırganlığını şok edici yeni bir terapi biçimine yönlendirir. Konseptleri tutulur ve her kasabada yeraltı “dövüş kulüpleri” kurulur, ta ki bir eksantrik yollarına çıkıp kontrolden çıkıp unutulmaya doğru bir sarmalın fitilini ateşleyene kadar.'),
(5, 'Interstellar', 'Christopher Nolan', 2014, 'Bilim Kurgu, Drama, Macera', 'afisler/117621-interstellar-0-1000-0-1500-crop.jpg', '2024-10-24 19:48:50', 'İnsanoğlu Dünya\'da doğdu. Burada ölmek için yaratılmamıştı.\r\nYeni keşfedilen bir solucan deliğinden yararlanarak insanoğlunun uzay yolculuğundaki sınırlamaları aşan ve yıldızlararası bir yolculukla ilgili engin mesafeleri fetheden bir grup kaşifin maceraları.'),
(6, 'Pulp Fiction', 'Quentin Tarantino', 1994, 'Suç, Gerilim', 'afisler/51444-pulp-fiction-0-1000-0-1500-crop.jpg', '2024-10-24 19:50:13', 'Kurguyu görmeden gerçekleri bilemezsiniz.\r\nHamburger seven bir kiralık katil, onun filozof ortağı, uyuşturucu bağımlısı bir gangsterin fahişesi ve bitkin bir boksör bu geniş kapsamlı, komedi dolu suç oyununda bir araya geliyor. Maceraları, zamanda ustaca ileri geri yolculuk yapan üç öyküde ortaya çıkıyor.'),
(7, 'Forrest Gump', ' Robert Zemeckis', 1994, 'Drama, Komedi, Romantik', 'afisler/2704-forrest-gump-0-1000-0-1500-crop.jpg', '2024-10-24 19:52:15', 'The world will never be the same once you’ve seen it through the eyes of Forrest Gump.\r\nA man with a low IQ has accomplished great things in his life and been present during significant historic events—in each case, far exceeding what anyone imagined he could do. But despite all he has achieved, his one true love eludes him.'),
(8, 'Stalker', 'Andrei Tarkovsky', 1979, 'Drama, Bilim Kurgu', 'afisler/51062-stalker-0-1000-0-1500-crop.jpg', '2024-10-24 19:53:23', 'Gri ve isimsiz bir şehrin yakınında, dikenli teller ve askerler tarafından korunan ve normal fizik kurallarının sık sık anomalilere kurban gittiği bir yer olan Bölge vardır. Bir takipçi, iki adamı Bölge\'ye, özellikle de derinlerde yatan arzuların gerçekleştiği bir alana yönlendirir.'),
(9, 'Come and See', 'Elem Klimov', 1985, 'Savaş, Drama', 'afisler/36192-come-and-see-0-1000-0-1500-crop.jpg', '2024-10-24 19:54:29', 'To love… to have children.\r\nAlman güçlerinin Beyaz Rusya\'daki bir köyü işgali, genç Florya\'yı ailesinin isteğine rağmen yorgun Direniş savaşçılarına katılması için ormana gönderir. Orada Glasha adında bir kızla tanışır ve kız ona köyüne kadar eşlik eder. Florya eve döndüğünde ailesini ve köylü arkadaşlarını katledilmiş olarak bulur. Savaşın acımasız enkazının ortasında hayatta kalmaya devam etmesi, umutsuzluk ve umut arasında bir savaş olarak giderek kabusa dönüşür.'),
(10, 'The Godfather', 'Francis Ford Coppola', 1972, 'Suç, Drama', 'afisler/51818-the-godfather-0-1000-0-1500-crop.jpg', '2024-10-24 19:55:40', 'Reddedemeyeceğiniz bir teklif.\r\n1945 ile 1955 yılları arasını kapsayan, İtalyan-Amerikan Corleone suç ailesinin kurgusal öyküsü. Organize suç ailesinin reisi Vito Corleone, hayatına kastedilmesinden kıl payı kurtulunca, en küçük oğlu Michael, katillerin icabına bakmak için devreye girer ve kanlı bir intikam kampanyası başlatır.'),
(11, 'Eternal Sunshine of the Spotless Mind', 'Michel Gondry', 2004, 'Bilim Kurgu, Romantik, Drama', 'afisler/uBfQ7IGpi0jXSP3GPCzp9Pzm10v-0-1000-0-1500-crop.jpg', '2024-10-24 19:56:50', 'Birini aklınızdan silebilirsiniz. Onları kalbinizden çıkarmak ise bambaşka bir hikâye.\r\nJoel Barish, kız arkadaşının kendisini hafızasından silmek için bir işlem yaptırmasına çok üzülür ve aynısını yapmaya karar verir. Ancak onunla ilgili anılarının yok oluşunu izlerken, onu hâlâ sevdiğini ve hatasını düzeltmek için çok geç kalmış olabileceğini fark eder.'),
(12, 'The Silence of the Lambs', 'Jonathan Demme', 1991, 'Korku, Suç, Gerilim, Drama', 'afisler/51782-the-silence-of-the-lambs-0-1000-0-1500-crop.jpg', '2024-10-24 19:57:55', 'Bir katilin zihnine girmek için bir delinin zihnine meydan okumalıdır.\r\nClarice Starling, FBI\'ın eğitim akademisinde en iyi öğrencilerden biridir. Jack Crawford, Clarice\'ten, aynı zamanda vahşi bir psikopat olan ve çeşitli cinayet ve yamyamlık eylemleri nedeniyle ömür boyu hapis cezasına çarptırılan parlak bir psikiyatrist olan Dr. Hannibal Lecter ile görüşmesini ister. Crawford, Lecter\'ın bir dava hakkında bilgi sahibi olabileceğine ve Starling\'in de çekici bir genç kadın olarak Lecter\'ı ortaya çıkaracak yem olabileceğine inanmaktadır.'),
(13, 'No Country for Old Men', 'Joel Coen, Ethan Coen', 2007, 'Suç, Gerilim, Drama', 'afisler/ehLb2SQ3djlA1FrQKbP2WO3VH09-0-1000-0-1500-crop.jpg', '2024-10-24 19:58:53', 'Temiz kaçış yoktur.\r\nLlewelyn Moss, Teksas çölünde cesetlere, 2 milyon dolara ve bir eroin deposuna rastlar, ancak metodik katil Anton Chigurh, yerel şerif Ed Tom Bell\'in peşine düşer. Para ve adaletin şiddetli arayışı çarpışırken av ve avcı rolleri bulanıklaşır.'),
(14, 'Memories of Murder', 'Bong Joon-ho', 2003, 'Gerilim, Drama, Su.', 'afisler/gawnVe9cFowdoDLo9Pok12NTw39-0-1000-0-1500-crop.jpg', '2024-10-24 20:00:16', 'En kötüleri sizinle kalacak... sonsuza dek.\r\n1980\'lerin sonlarında, Güney Kore\'nin bir eyaletinde iki dedektif ülkenin ilk tecavüz ve cinayet vakalarını çözmeye çalışır.'),
(15, 'The Thing', 'John Carpenter', 1982, 'Gizem, Bilim Kurgu, Korku', 'afisler/s5fH3GqFcHbi2F0NSBSh4KRNTc0-0-1000-0-1500-crop.jpg', '2024-10-24 20:01:26', 'İnsan saklanmak için en sıcak yerdir.\r\n1982 kışında, Antarktika\'daki uzak bir araştırma istasyonunda on iki kişilik bir araştırma ekibi, 100.000 yıldan uzun süredir karda gömülü olan bir uzaylı keşfeder. Kısa süre sonra donmuş halde bulunan bu şekil değiştiren yaratık ortalığı kasıp kavurur, dehşet saçar... ve onlardan biri haline gelir.'),
(16, 'GoodFellas', 'Martin Scorsese', 1990, 'Drama, Suç', 'afisler/51383-goodfellas-0-1000-0-1500-crop.jpg', '2024-10-24 20:04:27', 'Mafya hayatının otuz yılı.\r\nYarı İrlandalı, yarı Sicilyalı Brooklynli bir çocuk olan Henry Hill\'in küçük yaşta mahalle gangsterleri tarafından evlat edinilmesi ve Jimmy Conway\'in rehberliğinde bir mafya ailesinin basamaklarını tırmanmasının gerçek hikayesi.'),
(17, 'The Dark Knight', 'Christopher Nolan', 2008, 'Aksiyon, Drama, Gerilim, Suç', 'afisler/oefdD26aey8GPdx7Rm45PNncJdU-0-1000-0-1500-crop.jpg', '2024-10-24 20:05:41', 'Kuralsız bir dünyaya hoş geldiniz.\r\nBatman suça karşı savaşında çıtayı yükseltiyor. Batman, Teğmen Jim Gordon ve Bölge Savcısı Harvey Dent\'in yardımıyla, sokakları kasıp kavuran suç örgütlerini çökertmek için yola koyulur. Ortaklığın etkili olduğu kanıtlanır, ancak kısa süre sonra kendilerini Gotham\'ın dehşete düşmüş vatandaşları tarafından Joker olarak bilinen yükselen bir suç dehası tarafından serbest bırakılan bir kaos saltanatının avı olarak bulurlar.'),
(18, 'Whiplash', 'Whiplash', 2014, 'Drama, Müzik', 'afisler/4C9LHDxMsoYI0S3iMPZdm3Oevwo-0-1000-0-1500-crop.jpg', '2024-10-25 07:09:06', 'Mükemmelliğe giden yol sizi uçurumun kenarına götürebilir.\r\nAcımasız bir eğitmenin yönlendirmesi altında, yetenekli genç bir davulcu ne pahasına olursa olsun, hatta insanlığı pahasına mükemmelliğin peşinden gitmeye başlar.'),
(19, 'The Shining', 'Stanley Kubrick', 1980, 'Korku, Gerilim', 'afisler/caoYMcjUamGoBVy65i1AHJBvdzw-0-1000-0-1500-crop.jpg', '2024-10-25 07:12:04', 'Modern korkunun başyapıtı.\r\nJack Torrance, karısı Wendy ve oğulları Danny ile birlikte kış boyunca dünyanın geri kalanından izole bir şekilde yaşamak zorunda olduğu Overlook Oteli\'nde bekçilik işini kabul eder. Ancak içeride gizlenen deliliğe hazırlıklı değillerdir.'),
(20, 'The Truman Show', 'Peter Weir', 1998, 'Komedi, Drama', 'afisler/the-truman-show-0-1000-0-1500-crop.jpg', '2024-10-25 07:12:54', 'Yayında. Farkında olmadan.\r\nTruman Burbank, doğduğu andan itibaren, son otuz yıldır her günün her saniyesinde, tarihin en uzun soluklu, en popüler belgesel-soap operasının farkında olmadan yıldızı olmuştur. Ev olarak adlandırdığı mükemmel Seahaven kasabası aslında devasa bir ses sahnesi. Truman\'ın arkadaşları ve ailesi -aslında tanıştığı herkes- birer oyuncu. Her anını binlerce gizli TV kamerasının göz kırpmayan bakışları altında yaşıyor.'),
(21, 'The Matrix', 'Lana Wachowski, Lilly Wachowski', 1999, 'Bilim Kurgu, Aksiyon', 'afisler/51518-the-matrix-0-1000-0-1500-crop.jpg', '2024-10-25 07:13:45', 'Gelecek için mücadele başlıyor.\r\n22. yüzyılda geçen Matrix, artık dünyayı yöneten devasa ve güçlü bilgisayarlara karşı savaşan bir grup yeraltı isyancısına katılan bir bilgisayar korsanının hikayesini anlatıyor.'),
(22, 'Taxi Driver', 'Martin Scorsese', 1976, 'Drama, Suç', 'afisler/51947-taxi-driver-0-1000-0-1500-crop.jpg', '2024-10-25 07:15:05', 'Her şehrin her sokağında, önemli biri olmayı hayal eden bir hiç kimse vardır.\r\nAkli dengesi yerinde olmayan bir Vietnam Savaşı gazisi, New York\'ta gece taksi şoförü olarak çalışmaktadır ve burada algılanan çöküş ve adilik onun şiddet eylemi dürtüsünü beslemektedir.'),
(23, 'La La Land', 'Damien Chazelle', 2016, 'Drama, Komedi, Romantik, Müzik', 'afisler/240344-la-la-land-0-1000-0-1500-crop.jpg', '2024-10-25 07:19:05', 'Hayal kuran aptalların şerefine.\r\nHevesli bir aktris olan Mia, seçmeler arasında film yıldızlarına latte servisi yapmakta, caz müzisyeni Sebastian ise köhne barlarda kokteyl partisi konserleri vererek geçinmektedir; ancak başarı arttıkça, aşk ilişkilerinin kırılgan dokusunu yıpratmaya başlayan kararlarla karşı karşıya kalırlar ve birbirlerinde sürdürmek için çok çalıştıkları hayaller onları parçalamakla tehdit eder.'),
(24, 'Parasite', 'Bong Joon-ho', 2019, 'Komedi, Gerilim, Drama', 'afisler/426406-parasite-0-1000-0-1500-crop.jpg', '2024-10-25 07:22:06', 'Buranın sahibiymiş gibi davran.\r\nHepsi işsiz olan Ki-taek\'in ailesi, geçimlerini sağlamak için zengin ve göz alıcı Parks\'a özel bir ilgi duyar, ta ki beklenmedik bir olaya karışana kadar.'),
(25, 'Se7en', 'David Fincher', 1995, 'Suç, Gizem, Gerilim', 'afisler/51345-se7en-0-1000-0-1500-crop.jpg', '2024-10-25 07:24:31', 'Yedi ölümcül günah. Ölmenin yedi yolu.\r\nİki cinayet masası dedektifi, izleyicileri bir kurbanın işkence görmüş kalıntılarından diğerine götüren bu karanlık ve akıldan çıkmayan filmde, suçları “yedi ölümcül günaha” dayanan bir seri katilin umutsuzca peşine düşüyor. Tecrübeli Dedektif Sommerset, katilin zihnine girebilmek için her bir günahı araştırırken, acemi ortağı Mills onun davayı çözme çabalarıyla alay eder.'),
(26, 'Oppenheimer', 'Christopher Nolan', 2023, 'Tarih, Drama', 'afisler/784328-oppenheimer-0-1000-0-1500-crop.jpg', '2024-10-25 07:26:43', 'Dünya sonsuza dek değişiyor.\r\nJ. Robert Oppenheimer\'ın İkinci Dünya Savaşı sırasında atom bombasının geliştirilmesindeki rolünün öyküsü.'),
(27, 'The Shawshank Redemption', 'Frank Darabont', 1994, 'Suç, Drama', 'afisler/zGINvGjdlO6TJRu9wESQvWlOKVT-0-1000-0-1500-crop.jpg', '2024-10-25 07:28:03', 'Korku sizi tutsak edebilir. Umut sizi özgür bırakabilir.\r\n1940\'larda karısı ve sevgilisini çifte cinayetten hapse atılan dürüst bankacı Andy Dufresne, Shawshank hapishanesinde yeni bir hayata başlar ve burada muhasebe becerilerini ahlaksız bir müdür için kullanır. Hapishanede geçirdiği uzun süre boyunca Dufresne, dürüstlüğü ve sönmeyen umut duygusu nedeniyle Red adında yaşlı bir mahkûm da dahil olmak üzere diğer mahkûmlar tarafından takdir edilir.'),
(28, 'Blade Runner 2049', 'Denis Villeneuve', 2017, 'Bilim Kurgu, Drama', 'afisler/265439-blade-runner-2049-0-1000-0-1500-crop.jpg', '2024-10-25 07:43:14', 'Geleceğin anahtarı nihayet ortaya çıkarılıyor.\r\nİlk filmdeki olaylardan otuz yıl sonra, yeni bir blade runner olan LAPD Memuru K, toplumdan geriye kalanları kaosa sürükleme potansiyeline sahip uzun zamandır gömülü bir sırrı ortaya çıkarır. K\'nın keşfi, onu 30 yıldır kayıp olan eski LAPD blade runner\'ı Rick Deckard\'ı bulma arayışına yönlendirir.'),
(29, 'Joker', 'Todd Phillips', 2019, 'Suç, Gerilim, Drama', 'afisler/406775-joker-0-1000-0-1500-crop.jpg', '2024-10-25 07:43:59', 'Mutlu bir yüz takın.\r\n1980\'lerde, başarısız bir stand-up komedyeni delirir ve Gotham Şehri\'nde suç ve kaos dolu bir hayata yönelirken, kötü şöhretli bir psikopat suç figürü haline gelir.'),
(30, 'The Wolf of Wall Street', 'Martin Scorsese', 2013, 'Komedi, Drama, Suç', 'afisler/86114-the-wolf-of-wall-street-0-1000-0-1500-crop.jpg', '2024-10-25 07:44:45', 'Kazan. Harca. Parti.\r\nNew Yorklu bir borsacı, Wall Street\'teki yolsuzlukları, kurumsal bankacılık dünyasını ve mafyanın sızmasını içeren büyük bir menkul kıymet dolandırıcılığı davasında işbirliği yapmayı reddeder. Jordan Belfort\'un otobiyografisinden uyarlanmıştır.\r\n'),
(31, 'Spirited Away', 'Hayao Miyazaki', 2001, 'Aile, Fantazi, Animasyon', 'afisler/51921-spirited-away-0-1000-0-1500-crop.jpg', '2024-10-25 07:45:48', 'Genç bir kız olan Chihiro, yeni ve tuhaf bir ruhlar dünyasında kapana kısılır. Ailesi gizemli bir dönüşüm geçirdiğinde, ailesini kurtarmak için sahip olduğunu hiç bilmediği cesaretini çağırmalıdır.\r\n'),
(32, 'Dead Poets Society', 'Peter Weir', 1989, 'Drama', 'afisler/51846-dead-poets-society-0-1000-0-1500-crop.jpg', '2024-10-25 07:46:28', 'O onların ilham kaynağıydı. Hayatlarını olağanüstü hale getirdi.\r\nNew England\'daki seçkin, eski moda bir yatılı okulda, tutkulu bir İngilizce öğretmeni, öğrencilerine geleneklere başkaldırmaları ve her günün potansiyelini yakalamaları için ilham verirken, sert müdürün küçümsemesine neden olur.\r\n'),
(33, 'Django Unchained', 'Quentin Tarantino', 2012, 'Drama, Western', 'afisler/52516-django-unchained-0-1000-0-1500-crop.jpg', '2024-10-25 07:47:38', 'Hayat, özgürlük ve intikam arayışı.\r\nAzat edilmiş bir köle, Alman bir ödül avcısının yardımıyla karısını acımasız Mississippi plantasyon sahibinden kurtarmak için yola çıkar.'),
(34, 'Shutter Island', 'Martin Scorsese', 2010, 'Gerilim, Drama, Gizem', 'afisler/45409-shutter-island-0-1000-0-1500-crop.jpg', '2024-10-25 07:52:04', 'Bazı yerler gitmenize asla izin vermez.\r\nİkinci Dünya Savaşı askeriyken ABD\'li bir polis memuru olan Teddy Daniels, bir akıl hastanesindeki bir hastanın kayboluşunu araştırır, ancak çabaları rahatsız edici hayaller ve gizemli bir doktor tarafından tehlikeye atılır.'),
(35, 'Inglourious Basterds', 'Quentin Tarantino', 2009, 'Drama, Gerilim, Savaş', 'afisler/41352-inglourious-basterds-0-1000-0-1500-crop.jpg', '2024-10-25 07:55:13', 'Bir Basterd\'ın işi asla bitmez.\r\nİkinci Dünya Savaşı sırasında Nazi işgali altındaki Fransa\'da, “Basterds” olarak bilinen bir grup Yahudi-Amerikan askeri, Nazilerin kafa derilerini yüzerek ve vahşice öldürerek Üçüncü Reich\'a korku salmak için özel olarak seçilir. Teğmen Aldo Raine liderliğindeki Basterds\'ın yolu çok geçmeden Paris\'te bir sinema salonu işleten ve askerler tarafından hedef alınan Fransız-Yahudi bir genç kızla kesişir.'),
(36, 'Ratatouille', 'Brad Bird', 2007, 'Animasyon, Aile, Komedi, Fantazi', 'afisler/jEiEU8viSb8CIIHcfprVr2V6XDz-0-1000-0-1500-crop.jpg', '2024-10-25 07:57:48', 'He’s dying to become a chef.\r\nRemy, a resident of Paris, appreciates good food and has quite a sophisticated palate. He would love to become a chef so he can create and enjoy culinary masterpieces to his heart’s delight. The only problem is, Remy is a rat. When he winds up in the sewer beneath one of Paris’ finest restaurants, the rodent gourmet finds himself ideally placed to realize his dream.\r\n\r\n'),
(37, 'Eyes Wide Shut', 'Stanley Kubrick', 1999, 'Gerilim, Drama, Gizem', 'afisler/51717-eyes-wide-shut-0-1000-0-1500-crop.jpg', '2024-10-25 07:59:54', 'Cruise. Kidman. Kubrick.\r\nDr. Bill Harford\'un karısı Alice, tanıştığı bir adam hakkında cinsel fantezileri olduğunu itiraf ettikten sonra, Bill cinsel ilişkiye girmeyi takıntı haline getirir. Bir yeraltı cinsel grubunu keşfeder ve toplantılarından birine katılır - ve kısa sürede boyundan büyük işlere kalkıştığını keşfeder.'),
(38, 'Fallen Angels', 'Wong Kar-wai', 1995, 'Suç, Romantik, Aksiyon', 'afisler/45489-fallen-angels-0-1000-0-1500-crop.jpg', '2024-10-25 08:02:06', 'Gece tuhaflıklarla dolu.\r\nBir suikastçı, kendisine gizliden gizliye ilgi duyan ortağının karşı çıkmasına rağmen şiddet dolu yaşam tarzından kaçmaya çalışırken engellerle karşılaşır.');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `film_turleri`
--

CREATE TABLE `film_turleri` (
  `film_id` int NOT NULL,
  `tur_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `turler`
--

CREATE TABLE `turler` (
  `id` int NOT NULL,
  `tur_adi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Tablo döküm verisi `turler`
--

INSERT INTO `turler` (`id`, `tur_adi`) VALUES
(1, 'Dram'),
(2, 'Komedi'),
(3, 'Aksiyon'),
(4, 'Korku'),
(5, 'Bilim Kurgu');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'admin', '$2y$10$7k2knsLjX5ASM140Uz.r4O5z8/XP3uesDedu0KLXNd1u.kuDg0oIK', '2024-10-23 20:28:46'),
(5, 'serkan', '$2y$10$gVJWJAd.GPPeINlD3s2WuuJ2fWR0iG0JQyNmerCb/NbOfjJUPcYJu', '2024-10-25 17:43:24');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `filmler`
--
ALTER TABLE `filmler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `film_turleri`
--
ALTER TABLE `film_turleri`
  ADD PRIMARY KEY (`film_id`,`tur_id`),
  ADD KEY `tur_id` (`tur_id`);

--
-- Tablo için indeksler `turler`
--
ALTER TABLE `turler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `filmler`
--
ALTER TABLE `filmler`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Tablo için AUTO_INCREMENT değeri `turler`
--
ALTER TABLE `turler`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `film_turleri`
--
ALTER TABLE `film_turleri`
  ADD CONSTRAINT `film_turleri_ibfk_1` FOREIGN KEY (`film_id`) REFERENCES `filmler` (`id`),
  ADD CONSTRAINT `film_turleri_ibfk_2` FOREIGN KEY (`tur_id`) REFERENCES `turler` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
