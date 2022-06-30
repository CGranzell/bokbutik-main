-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Värd: 127.0.0.1
-- Tid vid skapande: 30 jun 2022 kl 11:45
-- Serverversion: 10.4.24-MariaDB
-- PHP-version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `e-shop`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `orders`
--

CREATE TABLE `orders` (
  `id` int(9) NOT NULL,
  `user_id` int(9) NOT NULL,
  `total_price` int(9) NOT NULL,
  `billing_full_name` varchar(150) NOT NULL,
  `billing_street` varchar(100) NOT NULL,
  `billing_postal_code` varchar(100) NOT NULL,
  `billing_city` varchar(100) NOT NULL,
  `billing_country` varchar(100) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellstruktur `order_items`
--

CREATE TABLE `order_items` (
  `id` int(9) NOT NULL,
  `order_id` int(9) NOT NULL,
  `product_id` int(9) NOT NULL,
  `product_title` varchar(150) NOT NULL,
  `quantity` int(9) NOT NULL,
  `unit_price` int(9) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellstruktur `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `title` varchar(90) NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `img_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumpning av Data i tabell `products`
--

INSERT INTO `products` (`id`, `title`, `description`, `price`, `stock`, `img_url`) VALUES
(151, 'Verity', 'OVER 3 MILLION COPIES SOLD - THE NO.1 BESTSELLER AND TIKTOK SENSATION, FROM THE AUTHOR OF IT ENDS WITH US Are you ready to stay up all night? Rebecca meets Gone Girl in this shocking, unpredictable thriller with a twist that will leave you reeling . . . Lowen Ashleigh is a struggling writer on the brink of financial ruin when she accepts the job offer of a lifetime. Jeremy Crawford, husband of bestselling author Verity Crawford, has hired Lowen to complete the remaining books in a successful series his injured wife is unable to finish. Lowen arrives at the Crawford home, ready to sort through years of Verity\'s notes and outlines, hoping to find enough material to get her started. What Lowen doesn\'t expect to uncover in the chaotic office is an unfinished autobiography Verity never intended for anyone to read. Page after page of bone-chilling admissions, including Verity\'s recollection of the night their family was forever altered. Lowen decides to keep the manuscript hidden from Jeremy, knowing its contents would devastate the already-grieving father.', 9, 12, 'img/Verity.jpeg'),
(152, 'A Good Girls´s Guide to Murder', 'The New York Times No.1 bestselling YA crime thriller that everyone is talking about! THE WINNER OF THE BRITISH BOOK AWARDS\' CHILDREN\'S BOOK OF THE YEAR 2020 SHORTLISTED FOR THE WATERSTONES CHILDREN\'S BOOK PRIZE 2020 \'A fiendishly-plotted mystery that kept me guessing until the very end.\' - Laura Purcell, bestselling author of The Silent Companions A debut YA crime thriller as addictive as Serial as compelling as Riverdale and as page-turning as One of Us Is Lying The case is closed. Five years ago, schoolgirl Andie Bell was murdered by Sal Singh. The police know he did it. Everyone in town knows he did it. But having grown up in the same small town that was consumed by the crime, Pippa Fitz-Amobi isn\'t so sure. When she chooses the case as the topic for her final project, she starts to uncover secrets that someone in town desperately wants to stay hidden. And if the real killer is still out there, how far will they go to keep Pip from the truth ... ? Perfect for fans of One of Us Is Lying, Gone Girl, We Were Liars and Riverdale Holly Jackson started writing stories from a young age, completing her first (poor) attempt at a novel aged fifteen. She lives in London and aside from reading and writing, she enjoys playing video games and watching true crime documentaries so she can pretend to be a detective. A Good Girl\'s Guide to Murder is her first novel. You can follow Holly on Twitter and Instagram @HoJay92', 10, 11, 'img/A-good-girls- guide-to-murder.jpeg'),
(153, 'The Man Who Died Twice', 'THE SECOND NOVEL IN THE RECORD-BREAKING, MILLION-COPY BESTSELLING THURSDAY MURDER CLUB SERIES BY RICHARD OSMAN ---------------------------------------------- \'Moving, hilarious, brilliantly suspenseful\' Jeffery Deaver \'A thing of joy\' Kate Atkinson \'The tonic we all need\' Shari Lapena It\'s the following Thursday. Elizabeth has received a letter from an old colleague, a man with whom she has a long history. He\'s made a big mistake, and he needs her help. His story involves stolen diamonds, a violent mobster, and a very real threat to his life. As bodies start piling up, Elizabeth enlists Joyce, Ibrahim and Ron in the hunt for a ruthless murderer. And if they find the diamonds too? Well, wouldn\'t that be a bonus? But this time they are up against an enemy who wouldn\'t bat an eyelid at knocking off four septuagenarians. Can the Thursday Murder Club find the killer (and the diamonds) before the killer finds them? ---------------------------------------------- \'This slick sequel will leave you buzzing\' The Times \'Fiendishly clever and brimming with wit on every page\' Shari Lapena \'He\'s not only done it again, but he\'s done it even better\' Philippa Perry \'Twisty, witty fun\' Sunday Express \'Superbly entertaining\' Guardian \'Full of humour and heart. I loved it\' Harlan Coben \'Darkly funny, offbeat and deftly written\' Irish Independent \'As gripping as it is funny\' Evening Standard \'If you liked The Thursday Murder Club, you\'re in for a treat, as this sequel is even better\' Good Housekeeping \'Warm, funny and oh-so British\' i \'A properly funny mystery steeped in Agatha Christie\' Araminta Hall \'It\'s like reading ice cream... a pure pleasure\' Linwood Barclay \'Osman\'s world is a soothing place to be\' Sunday Telegraph \'Pure pleasure to read\' Observer \'They\'ll cradle you through any winter of discontent\' Richard and Judy, Daily Express', 12, 22, 'img/the-man-who-died-twice.jpeg'),
(154, 'The Mamba Mentality', 'The Mamba Mentality: How I Play is Kobe Bryant\'s personal perspective of his life and career on the basketball court and his exceptional, insightful style of playing the game--a fitting legacy from the late Los Angeles Laker superstar. In the wake of his retirement from professional basketball, Kobe \"The Black Mamba\" Bryant decided to share his vast knowledge and understanding of the game to take readers on an unprecedented journey to the core of the legendary \"Mamba mentality.\" Citing an obligation and an opportunity to teach young players, hardcore fans, and devoted students of the game how to play it \"the right way,\" The Mamba Mentality takes us inside the mind of one of the most intelligent, analytical, and creative basketball players ever. In his own words, Bryant reveals his famously detailed approach and the steps he took to prepare mentally and physically to not just succeed at the game, but to excel. Readers will learn how Bryant studied an opponent, how he channeled his passion for the game, how he played through injuries. They\'ll also get fascinating granular detail as he breaks down specific plays and match-ups from throughout his career. Bryant\'s detailed accounts are paired with stunning photographs by the Hall of Fame photographer Andrew D. Bernstein. Bernstein, long the Lakers and NBA official photographer, captured Bryant\'s very first NBA photo in 1996 and his last in 2016--and hundreds of thousands in between, the record of a unique, twenty-year relationship between one athlete and one photographer. The combination of Bryant\'s narrative and Bernstein\'s photos make The Mamba Mentality an unprecedented look behind the curtain at the career of one of the world\'s most celebrated and fascinating athletes.', 27, 31, 'img/the-mamba-mentality.jpeg'),
(155, 'The Ugly Game: The Corruption of Fifa and the Qatari Plot to Buy the World Cup', 'The book that reminds you exactly what\'s wrong with FIFA? (Esquire UK): This meticulously reported account by two award-winning, investigative journalists at Britain\'s The Sunday Times explains how the 2022 World Cup was secured for Qatar?a key element in the ongoing, international FIFA controversy.\r\n\r\nWhen the tiny desert state of Qatar won the rights to host the 2022 World Cup, the news was greeted with shock and disbelief. How had a country with almost no soccer infrastructure or tradition, a high terror risk, and searing summer temperatures, beaten more established countries with stronger bids? The story behind the Qatari success soon developed into a global news sensation.\r\n\r\nIn 2014 The Sunday Times Insight team in the UK spilled the secrets of a bombshell cache of hundreds of millions of secret documents, which were leaked by a whistleblower. In forensic detail, they reported how Mohamed Bin Hammam, Qatar\'s top soccer official, used his position to help secure the votes that Qatar needed to win the bid. The investigative team spent three months painstakingly piecing together Bin Hammam\'s activities and reporting on cash handouts, lavish junkets, and evidence of payments to soccer officials around the world.\r\n\r\nNow in this remarkable book by The Sunday Times journalists at the center of the investigation, Heidi Blake and Jonathan Calvert, comes a comprehensive account of what happened and who was involved. A bestseller in the UK, The Ugly Game is undoubtedly the biggest sporting story of recent times.', 20, 25, 'img/the-ugly-game-the-corruption-of-fifa-and-the-qatari-plot-to-buy-the-world-cup_haftad.jpeg'),
(156, 'The book that reminds you exactly what\'s wrong with FIFA? (Esquire UK): This meticulously ', 'Remarkable Golf Courses encompasses the extremes of the sport - from the highest golf course in La Paz, Bolivia, to the lowest, in Death Valley, USA; from the most northerly in the Arctic Circle to the most southerly in Tierra del Fuego. The many quirks of the golfing world are covered, such as the 18th green the other side of the River Lea which is serviced by an electric ferry, or the LA golf course that has its own funicular railway, or the floating golf hole in Idaho, where it\'s not just the pin position that\'s changed every day, it\'s the distance from the shore! Golf courses that feature neolithic standing stones (Scotland), Roman roads (England), and ruined medieval castles (Wales) take their place alongside the old temples of Delhi or a UNESCO World Heritage bridge that is used to link the 9th and 10th at Angkor Wat. There are the beloved classic courses of St. Andrews, Carnoustie, Royal St. George and Westward Ho!. There are spectacular golf courses hewn out of the Nevada and Arizona desert, green oases in a cactus-strewn, rocky landscape, along with Hawaiian courses fringed by barren black lava flows. But nothing can beat the thrill in Guatemala of lining up your drive on an active volcano at the Fuego Maya course. In comparison there are the traditional wind-blown Scottish links, such as the Machrie Hotel on the island of Islay which has the most blind greens on any course, or the remote Isle of Barra where greens are only accessible via a kissing gate. Fancy swapping countries mid-round? You can at the Llanmymynech club in Wales. At the fourth hole golfers tee off in Wales and putt out on the green in England. Remarkable Golf Courses brings together some astonishing stories with some extraordinary photography.', 25, 40, 'img/remarkable-golf-courses.jpeg'),
(157, 'Finding the Mother Tree', 'THE INTERNATIONAL BESTSELLER \'A scientific memoir as gripping as any HBO drama series\' Kate Kellaway, Observer A dazzling scientific detective story from the ecologist who first discovered the hidden language of trees No one has done more to transform our understanding of trees than the world-renowned scientist Suzanne Simard. Now she shares the secrets of a lifetime spent uncovering startling truths about trees: their cooperation, healing capacity, memory, wisdom and sentience. Raised in the forests of British Columbia, where her family has lived for generations, Professor Simard did not set out to be a scientist. She was working in the forest service when she first discovered how trees communicate underground through an immense web of fungi, at the centre of which lie the Mother Trees: the mysterious, powerful entities that nurture their kin and sustain the forest. Though her ground-breaking findings were initially dismissed and even ridiculed, they are now firmly supported by the data. As her remarkable journey shows us, science is not a realm apart from ordinary life, but deeply connected with our humanity. In Finding the Mother Tree, she reveals how the complex cycle of forest life - on which we rely for our existence - offers profound lessons about resilience and kinship, and must be preserved before it\'s too late.', 12, 13, 'img/finding-the-mother-tree.jpeg'),
(158, 'Entangled Life', 'The smash-hit Sunday Times and #1 Amazon Charts bestseller that will transform your understanding of our planet and life itself. \'Dazzling, vibrant, vision-changing\' Robert Macfarlane Winner of the Royal Society Science Book Prize 2021 Winner of the Wainwright Prize for Conservation Writing 2021 The more we learn about fungi, the less makes sense without them. They can change our minds, heal our bodies and even help us avoid environmental disaster; they are metabolic masters, earth-makers and key players in most of nature\'s processes. In Entangled Life, Merlin Sheldrake takes us on a mind-altering journey into their spectacular world, and reveals how these extraordinary organisms transform our understanding of our planet and life itself. \'Gorgeous!\' Margaret Atwood (on Twitter) \'Reads like an adventure story... Wondrous\' Sunday Times \'Urgent, astounding and necessary\' Helen Macdonald Perfect for fans of David Attenborough\'s The Green Planet and The Hidden Life of Trees by Peter Wohlleben * A Sunday Times, Daily Telegraph, New Statesman, The Times, Evening Standard, Mail on Sunday, BBC Science Focus, TLS and Time Book of the Year', 21, 3, 'img/entangled-life.jpeg'),
(161, 'Ny bok uppdaterad', 'Ny bok', 12, 2, 'img/the-last-days-of-the-dinosaurs.jpeg');

-- --------------------------------------------------------

--
-- Tabellstruktur `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(60) NOT NULL,
  `last_name` varchar(60) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(60) NOT NULL,
  `phone` varchar(60) NOT NULL,
  `street` varchar(255) NOT NULL,
  `postal_code` varchar(255) NOT NULL,
  `city` varchar(90) NOT NULL,
  `country` varchar(90) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumpning av Data i tabell `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `phone`, `street`, `postal_code`, `city`, `country`, `create_date`) VALUES
(149, 'Christoffer', 'Granzell', 'cgranzell@hotmail.com', '$2y$10$jNqOnA90ld4H/0765WTM6OB0nyJscRHhUEDnwIltl99Y5LrSeK05O', '+46739398943', 'Hellbergs väg 18a', '79136', 'Falun', 'Sverige', '2022-06-30 07:54:57');

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT för tabell `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT för tabell `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;

--
-- AUTO_INCREMENT för tabell `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
