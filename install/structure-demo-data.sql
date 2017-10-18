SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT = @@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS = @@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION = @@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `library`
--

-- --------------------------------------------------------

--
-- Структура таблицы `author`
--

CREATE TABLE `author` (
  `id`         INT(11)                 NOT NULL,
  `first_name` VARCHAR(64)
               COLLATE utf8_unicode_ci NOT NULL,
  `last_name`  VARCHAR(64)
               COLLATE utf8_unicode_ci NOT NULL
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8
  COLLATE = utf8_unicode_ci;

--
-- Дамп данных таблицы `author`
--

INSERT INTO `author` (`id`, `first_name`, `last_name`) VALUES
  (1, 'Stephen', 'King'),
  (2, 'Howard', 'Lovecraft'),
  (3, 'Haruki', 'Murakami'),
  (4, 'Clifford', 'Simak'),
  (78, 'Helmut', 'Koester'),
  (79, 'William E.', 'Kasdorf'),
  (80, 'A. T.', 'Olmstead'),
  (81, 'R. Gordon ', 'Wasson'),
  (82, 'Charles M.', 'Brand'),
  (83, 'Mawi', 'Asgedom'),
  (84, 'Lily Ross', 'Taylor'),
  (85, 'Edward O.', 'Wilson'),
  (86, 'Scott', 'Hahn'),
  (87, 'Andre', 'Dubus III'),
  (88, 'Julien', 'Temple'),
  (89, 'Omar', 'Khayyam'),
  (90, 'Anthony D.', 'Williams'),
  (91, 'Luke Timothy ', 'Johnson'),
  (92, 'R. J. ', 'Overy'),
  (93, 'Robertson', 'Davies'),
  (94, 'John W. ', 'O`Malley'),
  (95, 'Susanna', 'Clarke'),
  (96, 'Lev', 'Tolstoy');

-- --------------------------------------------------------

--
-- Структура таблицы `book`
--

CREATE TABLE `book` (
  `id`          INT(11)                      NOT NULL,
  `author_id`   INT(11) DEFAULT NULL,
  `title`       VARCHAR(128)
                COLLATE utf8_unicode_ci      NOT NULL,
  `description` TEXT COLLATE utf8_unicode_ci NOT NULL,
  `created`     DATETIME                     NOT NULL
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8
  COLLATE = utf8_unicode_ci;

--
-- Дамп данных таблицы `book`
--

INSERT INTO `book` (`id`, `author_id`, `title`, `description`, `created`) VALUES
  (1, 1, 'It',
   'It is a 1986 horror novel by American author Stephen King. It was his 22nd book and 18th novel written under his own name. The story follows the experiences of seven children as they are terrorized by an entity that exploits the fears and phobias of its victims to disguise itself while hunting its prey. "It" primarily appears in the form of a clown to attract its preferred prey of young children.',
   '2017-10-19 00:26:27'),
  (2, 1, 'The Shining', 'The Shining is a horror novel by American author Stephen King. Published in 1977, it is King\'s third published novel and first hardback bestseller: the success of the book firmly established King as a preeminent author in the horror genre. The setting and characters are influenced by King\'s personal experiences, including both his visit to The Stanley Hotel in 1974 and his recovery from alcoholism. The novel was followed by a sequel, Doctor Sleep, published in 2013.', '2017-10-19 00:26:27'),
  (3, 2, 'The Call of Cthulhu', '"The Call of Cthulhu" is a short story by the American writer H. P. Lovecraft. Written in the summer of 1926, it was first published in the pulp magazine Weird Tales, in February 1928.', '2017-10-19 00:26:27'),
  (4, 2, 'The Shadow over Innsmouth', 'The Shadow over Innsmouth is a horror novella by American author H. P. Lovecraft, written in November–December 1931. It forms part of the Cthulhu Mythos, using its motif of a malign undersea civilization, and references several shared elements of the Mythos, including place-names, mythical creatures, and invocations. The Shadow over Innsmouth is the only Lovecraft story which was published in book form during his lifetime', '2017-10-19 00:26:27'),
  (5, 4, 'Way Station', 'Way Station is a 1963 science fiction novel by American writer Clifford D. Simak, originally published as Here Gather the Stars in two parts in Galaxy Magazine in June and August 1963. Way Station won the 1964 Hugo Award for Best Novel.', '2017-10-19 00:26:27'),
  (6, 4, 'The Goblin Reservation', 'The Goblin Reservation is a 1968 science fiction novel by American writer Clifford D. Simak, featuring an educated Neanderthal, a biomechanical sabertooth tiger, aliens that move about on wheels, a man who time-travels using an unreliable device implanted in his brain, a ghost, trolls, banshees, goblins, a dragon and even Shakespeare himself. The Goblin Reservation was a Hugo Award nominee in 1969 and was originally serialized in Galaxy Science Fiction magazine.', '2017-10-19 00:26:27'),
  (7, 3, 'Norwegian Wood', 'Norwegian Wood (ノルウェイの森 Noruwei no Mori) is a 1987 novel by Japanese author Haruki Murakami. The novel is a nostalgic story of loss and burgeoning sexuality.[2] It is told from the first-person perspective of Toru Watanabe, who looks back on his days as a college student living in Tokyo. Through Watanabe\'s reminiscences we see him develop relationships with two very different women — the beautiful yet emotionally troubled Naoko, and the outgoing, lively Midori.', '2017-10-19 00:26:27'),
  (8, 3, 'Sputnik Sweetheart', 'Sputnik Sweetheart (スプートニクの恋人 Supūtoniku no Koibito) is a novel by Haruki Murakami, published in Japan, by Kodansha, in 1999. An English translation by Philip Gabriel was then published in 2001.', '2017-10-19 00:26:27'),
  (9, 3, 'Kafka on the Shore', 'Kafka on the Shore (海辺のカフカ Umibe no Kafuka) is a 2002 novel by Japanese author Haruki Murakami.', '2017-10-19 00:26:27'),
  (30, 78, 'Introduction to the New Testament!', 'Imagine you are at Hardee\'s and you order a specific deal, lets say, "Big Hardee" and they hand it over to you without any questions; this is the example of simple factory. But there are cases when the creation logic might involve more steps. For example you want a customized Subway deal, you have several options in how your burger is made e.g what bread do you want? what types of sauces would you like? What cheese would you want? etc. In such cases builder pattern comes to the rescue. Test ok.', '2017-10-19 00:26:27'),
  (31, 91, 'The Columbia Guide to Digital Publishing', 'Imagine we have a build tool that helps us test, lint, build, generate build reports (i.e. code coverage reports, linting report etc) and deploy our app on the test server.', '2017-10-19 00:26:27'),
  (33, 80, 'History of the Persian Empire: Achaemenid period', 'In software engineering, the template method pattern is a behavioral design pattern that defines the program skeleton of an algorithm in an operation, deferring some steps to subclasses. It lets one redefine certain steps of an algorithm without changing the algorithm\'s structure.', '2017-10-19 00:26:27'),
  (34, 81, 'The road to Eleusis: unveiling the secret of the mysteries', 'Design patterns are solutions to recurring problems; guidelines on how to tackle certain problems. They are not classes, packages or libraries that you can plug into your application and wait for the magic to happen. These are, rather, guidelines on how to tackle certain problems in certain situations.', '2017-10-19 00:26:27'),
  (35, 82, 'Icon and minaret: sources of Byzantine and Islamic civilization', 'The prototype pattern is a creational design pattern in software development. It is used when the type of objects to create is determined by a prototypical instance, which is cloned to produce new objects.', '2017-10-19 00:26:27'),
  (36, 83, 'Of Beetles and Angels: A Boy`s Remarkable Journey from a Refugee Camp to Harvard', 'In software engineering, creational design patterns are design patterns that deal with object creation mechanisms, trying to create objects in a manner suitable to the situation. The basic form of object creation could result in design problems or added complexity to the design. Creational design patterns solve this problem by somehow controlling this object creation.', '2017-10-19 00:26:27'),
  (37, 84, 'Party politics in the age of Caesar', 'Consider, you are building a house and you need doors. It would be a mess if every time you need a door, you put on your carpenter clothes and start making a door in your house. Instead you get it made from a factory.\n', '2017-10-19 00:26:27'),
  (38, 85, 'The diversity of life', 'In class-based programming, the factory method pattern is a creational pattern that uses factory methods to deal with the problem of creating objects without having to specify the exact class of the object that will be created. This is done by creating objects by calling a factory method—either specified in an interface and implemented by child classes, or implemented in a base class and optionally overridden by derived classes—rather than by calling a constructor.\n', '2017-10-19 00:26:27'),
  (39, 86, 'The Lamb`s Supper: The Mass as Heaven on Earth', 'The abstract factory pattern provides a way to encapsulate a group of individual factories that have a common theme without specifying their concrete classes\n', '2017-10-19 00:26:27'),
  (40, 87, 'House of Sand and Fog (Oprah\'s Book Club)', 'Long story short', '2017-10-19 00:26:27'),
  (41, 88, 'The Filth and the Fury - A Sex Pistols Film', 'In software engineering, creational design patterns are design patterns that deal with object creation mechanisms, trying to create objects in a manner suitable to the situation. The basic form of object creation could result in design problems or added complexity to the design. Creational design patterns solve this problem by somehow controlling this object creation.', '2017-10-19 00:26:27'),
  (44, 90, 'Wikinomics', 'Consider, you are building a house and you need doors. It would be a mess if every time you need a door, you put on your carpenter clothes and start making a door in your house. Instead you get it made from a factory.\n', '2017-10-19 00:26:27'),
  (45, 91, 'The creed : what Christians believe and why it matters',
   'Imagine you are at Hardee\'s and you order a specific deal, lets say, "Big Hardee" and they hand it over to you without any questions; this is the example of simple factory. But there are cases when the creation logic might involve more steps. For example you want a customized Subway deal, you have several options in how your burger is made e.g what bread do you want? what types of sauces would you like? What cheese would you want? etc. In such cases builder pattern comes to the rescue.',
   '2017-10-19 00:26:27'),
  (46, 92, 'Why the allies won',
   'In software engineering, creational design patterns are design patterns that deal with object creation mechanisms, trying to create objects in a manner suitable to the situation. The basic form of object creation could result in design problems or added complexity to the design. Creational design patterns solve this problem by somehow controlling this object creation.',
   '2017-10-19 00:26:27'),
  (49, 95, 'The ladies of Grace Adieu: and other stories', 'Long story short and other cool words.',
   '2017-10-19 00:26:27'),
  (50, 87, 'Great Title', 'Awesome text. Sequel is coming soon!', '2017-10-19 00:26:27'),
  (51, 96, 'War and Peace',
   'The novel chronicles the history of the French invasion of Russia and the impact of the Napoleonic era on Tsarist society through the stories of five Russian aristocratic families. Portions of an earlier version, titled The Year 1805,[4] were serialized in The Russian Messenger from 1865 to 1867. The novel was first published in its entirety in 1869.[5]',
   '2017-10-19 00:26:27');

-- --------------------------------------------------------

--
-- Структура таблицы `fos_user_group`
--

CREATE TABLE `fos_user_group` (
  `id`    INT(11)                          NOT NULL,
  `name`  VARCHAR(255)
          COLLATE utf8_unicode_ci          NOT NULL,
  `roles` LONGTEXT COLLATE utf8_unicode_ci NOT NULL
  COMMENT '(DC2Type:array)'
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8
  COLLATE = utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `fos_user_user`
--

CREATE TABLE `fos_user_user` (
  `id`                    INT(11)                          NOT NULL,
  `username`              VARCHAR(255)
                          COLLATE utf8_unicode_ci          NOT NULL,
  `username_canonical`    VARCHAR(255)
                          COLLATE utf8_unicode_ci          NOT NULL,
  `email`                 VARCHAR(255)
                          COLLATE utf8_unicode_ci          NOT NULL,
  `email_canonical`       VARCHAR(255)
                          COLLATE utf8_unicode_ci          NOT NULL,
  `enabled`               TINYINT(1)                       NOT NULL,
  `salt`                  VARCHAR(255)
                          COLLATE utf8_unicode_ci          NOT NULL,
  `password`              VARCHAR(255)
                          COLLATE utf8_unicode_ci          NOT NULL,
  `last_login`            DATETIME                DEFAULT NULL,
  `locked`                TINYINT(1)                       NOT NULL,
  `expired`               TINYINT(1)                       NOT NULL,
  `expires_at`            DATETIME                DEFAULT NULL,
  `confirmation_token`    VARCHAR(255)
                          COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` DATETIME                DEFAULT NULL,
  `roles`                 LONGTEXT COLLATE utf8_unicode_ci NOT NULL
  COMMENT '(DC2Type:array)',
  `credentials_expired`   TINYINT(1)                       NOT NULL,
  `credentials_expire_at` DATETIME                DEFAULT NULL,
  `created_at`            DATETIME                         NOT NULL,
  `updated_at`            DATETIME                         NOT NULL,
  `date_of_birth`         DATETIME                DEFAULT NULL,
  `firstname`             VARCHAR(64)
                          COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastname`              VARCHAR(64)
                          COLLATE utf8_unicode_ci DEFAULT NULL,
  `website`               VARCHAR(64)
                          COLLATE utf8_unicode_ci DEFAULT NULL,
  `biography`             VARCHAR(1000)
                          COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender`                VARCHAR(1)
                          COLLATE utf8_unicode_ci DEFAULT NULL,
  `locale`                VARCHAR(8)
                          COLLATE utf8_unicode_ci DEFAULT NULL,
  `timezone`              VARCHAR(64)
                          COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone`                 VARCHAR(64)
                          COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook_uid`          VARCHAR(255)
                          COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook_name`         VARCHAR(255)
                          COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook_data`         LONGTEXT COLLATE utf8_unicode_ci COMMENT '(DC2Type:json)',
  `twitter_uid`           VARCHAR(255)
                          COLLATE utf8_unicode_ci DEFAULT NULL,
  `twitter_name`          VARCHAR(255)
                          COLLATE utf8_unicode_ci DEFAULT NULL,
  `twitter_data`          LONGTEXT COLLATE utf8_unicode_ci COMMENT '(DC2Type:json)',
  `gplus_uid`             VARCHAR(255)
                          COLLATE utf8_unicode_ci DEFAULT NULL,
  `gplus_name`            VARCHAR(255)
                          COLLATE utf8_unicode_ci DEFAULT NULL,
  `gplus_data`            LONGTEXT COLLATE utf8_unicode_ci COMMENT '(DC2Type:json)',
  `token`                 VARCHAR(255)
                          COLLATE utf8_unicode_ci DEFAULT NULL,
  `two_step_code`         VARCHAR(255)
                          COLLATE utf8_unicode_ci DEFAULT NULL
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8
  COLLATE = utf8_unicode_ci;

--
-- Дамп данных таблицы `fos_user_user`
--

INSERT INTO `fos_user_user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`, `created_at`, `updated_at`, `date_of_birth`, `firstname`, `lastname`, `website`, `biography`, `gender`, `locale`, `timezone`, `phone`, `facebook_uid`, `facebook_name`, `facebook_data`, `twitter_uid`, `twitter_name`, `twitter_data`, `gplus_uid`, `gplus_name`, `gplus_data`, `token`, `two_step_code`)
VALUES
  (1, 'admin', 'admin', 'admin@library.local', 'admin@library.local', 1, 'c351gy6izs0kocs04kw4sgskogc0s48',
      'dC9W2IgJDkUNnyXebfvU/7MXkBf+PplslQaneOKiWz6u/WYS6v+b758Z7RuQCFP408fdEgu04A2J02EgDwQttQ==', '2017-10-17 23:33:45',
      0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:16:"ROLE_SUPER_ADMIN";}', 0, NULL, '2017-10-17 23:33:14',
            '2017-10-17 23:36:28', NULL, NULL, NULL, NULL, NULL, 'u', NULL, NULL, NULL, NULL, NULL, 'null', NULL, NULL,
   'null', NULL, NULL, 'null', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `fos_user_user_group`
--

CREATE TABLE `fos_user_user_group` (
  `user_id`  INT(11) NOT NULL,
  `group_id` INT(11) NOT NULL
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8
  COLLATE = utf8_unicode_ci;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_CBE5A3312B36786B` (`title`),
  ADD KEY `IDX_CBE5A331F675F31B` (`author_id`);

--
-- Индексы таблицы `fos_user_group`
--
ALTER TABLE `fos_user_group`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_583D1F3E5E237E06` (`name`);

--
-- Индексы таблицы `fos_user_user`
--
ALTER TABLE `fos_user_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_C560D76192FC23A8` (`username_canonical`),
  ADD UNIQUE KEY `UNIQ_C560D761A0D96FBF` (`email_canonical`);

--
-- Индексы таблицы `fos_user_user_group`
--
ALTER TABLE `fos_user_user_group`
  ADD PRIMARY KEY (`user_id`, `group_id`),
  ADD KEY `IDX_B3C77447A76ED395` (`user_id`),
  ADD KEY `IDX_B3C77447FE54D947` (`group_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `author`
--
ALTER TABLE `author`
  MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 97;
--
-- AUTO_INCREMENT для таблицы `book`
--
ALTER TABLE `book`
  MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 52;
--
-- AUTO_INCREMENT для таблицы `fos_user_group`
--
ALTER TABLE `fos_user_group`
  MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `fos_user_user`
--
ALTER TABLE `fos_user_user`
  MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 2;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `FK_CBE5A331F675F31B` FOREIGN KEY (`author_id`) REFERENCES `author` (`id`);

--
-- Ограничения внешнего ключа таблицы `fos_user_user_group`
--
ALTER TABLE `fos_user_user_group`
  ADD CONSTRAINT `FK_B3C77447A76ED395` FOREIGN KEY (`user_id`) REFERENCES `fos_user_user` (`id`)
  ON DELETE CASCADE,
  ADD CONSTRAINT `FK_B3C77447FE54D947` FOREIGN KEY (`group_id`) REFERENCES `fos_user_group` (`id`)
  ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS = @OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION = @OLD_COLLATION_CONNECTION */;
