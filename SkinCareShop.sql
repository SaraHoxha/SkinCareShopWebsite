-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 14, 2022 at 04:18 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `SkinCareShop`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `CustomerId` int(11) NOT NULL,
  `Username` varchar(50) DEFAULT NULL,
  `CardNumber` int(11) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Passwrd` varchar(50) DEFAULT NULL,
  `FirstName` varchar(50) DEFAULT NULL,
  `LastName` varchar(50) DEFAULT NULL,
  `Address` varchar(50) DEFAULT NULL,
  `PostalCode` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`CustomerId`, `Username`, `CardNumber`, `Email`, `Passwrd`, `FirstName`, `LastName`, `Address`, `PostalCode`) VALUES
(1, 'sarah', 1348923, 'sarahoxha99@gmail.com', '1108', 'Sara', 'Hoxha', 'Sara', 1833),
(5, 'xhesi', 123784, 'xhesihoxha@yahoo.com', '110820', 'Xhesi', 'Hoxha', 'Jordan Misja', 1067);

-- --------------------------------------------------------

--
-- Table structure for table `customerorder`
--

CREATE TABLE `customerorder` (
  `OrderId` int(11) NOT NULL,
  `OrderDate` date DEFAULT NULL,
  `OrderStatus` varchar(50) DEFAULT NULL,
  `CustomerId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customerorder`
--

INSERT INTO `customerorder` (`OrderId`, `OrderDate`, `OrderStatus`, `CustomerId`) VALUES
(13, '2022-06-13', 'Processing', 1),
(14, '2022-06-13', 'Processing', 1),
(15, '2022-06-13', 'Processing', 1),
(16, '2022-06-13', 'Processing', 1),
(17, '2022-06-13', 'Processing', 1),
(18, '2022-06-13', 'Processing', 1),
(19, '2022-06-13', 'Processing', 1),
(20, '2022-06-14', 'Processing', 5);

-- --------------------------------------------------------

--
-- Table structure for table `orderitem`
--

CREATE TABLE `orderitem` (
  `OrderItemId` int(11) NOT NULL,
  `OrderId` int(11) DEFAULT NULL,
  `ProductId` int(11) DEFAULT NULL,
  `QuantityOrdered` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orderitem`
--

INSERT INTO `orderitem` (`OrderItemId`, `OrderId`, `ProductId`, `QuantityOrdered`) VALUES
(16, 13, 9, 2),
(17, 13, 14, 1),
(18, 13, 17, 1),
(19, 13, 3, 1),
(20, 13, 2, 1),
(21, 13, 5, 1),
(22, 13, 2, 1),
(23, 13, 6, 1),
(24, 13, 6, 1),
(25, 13, 9, 1),
(26, 20, 14, 2);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `ProductId` int(11) NOT NULL,
  `ProductName` varchar(100) DEFAULT NULL,
  `ProductBrand` varchar(50) DEFAULT NULL,
  `ProductDescription` text DEFAULT NULL,
  `QuantityAvailable` int(11) DEFAULT NULL,
  `Price` double DEFAULT NULL,
  `Category` varchar(100) DEFAULT NULL,
  `ProductImage` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ProductId`, `ProductName`, `ProductBrand`, `ProductDescription`, `QuantityAvailable`, `Price`, `Category`, `ProductImage`) VALUES
(1, 'Body Mist', 'Dare Deep', 'Body mist perfect for every age. Unique body spray lotion with hyaluronic acid, sunflower seed oil, and vitamins B5 and E intensely hydrates skin for 48 hours. Exclusive HydroSensitiv Complex™ with soothing blue daisy deepens dynamic hydration and soothes skin to improve the quality of sensitive skin over time .', 10, 19, 'Body', 'BodyMist.jpeg'),
(2, 'Aromatica Scalp Scaling Shampoo', 'Rosemary', 'Frequent hair styling such as dyeing, perming, and drying damages hair and weakens your scalp. Rosemary 3-in-1 treatment not only intensively nourishes hair but also adds shine and softness to your hair. 3-in-1 multi care is the right solution to damaged hair troubles.', 18, 23, 'Hair', 'Aromatica.jpeg'),
(3, 'Hyaluronic Acid Watery Sun Gel SPF 50+', 'ISNTREE', '8 Types of Hyaluronic Acid, Strong Protection Against UVA and UVB Rays, No White Cast, Reef-safe, Non-nano Sunscreen. With a great rating of 4.5 out of 5.', 13, 26, 'Body', 'Sunscream.jpeg'),
(4, 'Wonder Bubble Shampoo', 'LA\'DOR', 'Rich and refined foaming shampoo contains seven kinds of peptide extracted from soybean to strengthen and nourish hair and scalp, leaving hair clean, soft, bouncy and voluminous.\r\n', 5, 23, 'Hair', 'BubbleShampoo.jpeg'),
(5, 'Anti Dandruff Shampoo', 'LA\'DOR', 'Boasts a blend of herbal extracts to nourish hair and scalp, salicylic acid to remove dead skin cells as well as menthol to soothe and freshen up scalp. Its herbal-scented formula soothes the senses while thoroughly cleansing your locks and scalp – providing hydration and protection as well as banishing itchiness.', 6, 32, 'Hair', 'AntiDandruff.jpeg'),
(6, 'Keratin LPP Repair Shampoo', 'LA\'DOR', 'Nourishing Sub-acid Shampoo pH 6.0 Dry Damaged Colored Permed Hair Thinning Hair No Silicone No Harmful Ingredients, with Wheat Protein Silk Protein. ', 5, 26, 'Hair', 'KeratinShampoo.jpeg'),
(7, 'Centella Unscented Serum', 'Purito', 'This serum rejuvenates the skin by strengthening its barrier. It contains essential Centella ingredients to restore a damaged skin barrier and soothe irritated skin. The Centella Asiatica Extract and Panthenol help calm the irritated skin preventing further inflammation. If your skin is stressed using too many products with various ingredients that do not fit your skin, give your face a break and help it restore by using the Centella Unscented Serum.', 0, 18, 'Skincare', 'Serum.jpeg'),
(8, 'Green Deep Foaming Cleanser', 'Purito', 'This cleanser is formulated with natural ingredients and does not contain chemical surfactants such as SLS and SLES, which can cause irritation, making it great for people with all skin types including sensitive skin. It leaves the skin moisturized after cleansing and is great for morning and nighttime use. Keeping skin\'s acid mantle at the optimal pH of 5.5, this cleanser protects the skin barrier. Keeping skin\'s acid mantle at the optimal pH of 5.5, this cleanser protects the skin barrier.', 32, 12, 'Skincare', 'FoamingCleanser.jpeg'),
(9, 'Anti-Yellow Shampoo ', 'LA\'DOR', 'POTENT PURPLE PIGMENT - Using the Complementary Color Principle, the yellowing that happens to ly colored/bleached hair is controlled with purple pigments. STRONG ON HAIR, MINIMUM STAIN ON SKIN - Potent pigments are important for the anti-yellowing effect to take place, but you\'ll also want to be careful not to stain your skin. The special formulation makes this less staining than other shampoos out there. MOISTURIZING WITH COLOR PRESERVATION - Fighting against the yellowing with pigments is a great start, but hair that has been dyed and/or bleached need more care than that. This shampoo is also designed to help impart moisture at the same time.', 10, 24, 'Hair', 'AntiYellowShampoo.jpeg'),
(10, 'Black Bean Anti Hair Loss Shampoo', 'Nature Republic', 'NATURAL INGREDIENTS: The main ingredient of Nature Republic Black Bean Anti Hair Loss Shampoo is black beans that are great plant-based source of protein, which is essential to hair growth. Black beans are good source of zinc, which aids the hair growth and repair cycle. Also beans provide many other hair-healthy nutrients, including iron, biotin and folate.', 23, 18, 'Hair', 'AntiHairLoss.jpeg'),
(11, 'Cicapair Re-Cover', 'Dr. Jart++', 'mineral solution and panthenol strengthen natural skin force. Strawberry leaf extracts alleviate skin irritation and protect the skin from external harmful stimuli and environment. Formulated WITHOUT Parabens, Sulfates, Phthalates. Green-to-Beige color change texture represents healthy skin by covering the skin turned red due to stress. Formulated WITHOUT Parabens, Sulfates, Phthalates', 2, 45, 'Body', 'FaceCream.jpeg'),
(12, 'PERFECT COVER BB CREAM ', 'MISSHA M', 'FLAWLESS COVERAGE: Smoothly conceals imperfections, balances skin tone, and visibly smooths complexion for a youthfully perfected look. DEWY AND MOISTURIZING: Keeps your skin hydrated and soft with powerful ceramides, hyaluronic acid, and Gatuline RC. NATURALLY CONDITIONING: Infused with nourishing botanical essences, emollient plant oils, and nutrient rich marine extracts to replenish the look and feel of skin. GATULINE RC, HYALURONIC ACID, CERAMID: Help infuse moisture for firmer looking skin with reduction in appearance of fine lines & wrinkles. ROSEMARY AND CHAMOMILE EXTRACTS: Fragrant herbal botanical that help the complexion appear calm and balanced', 10, 58, 'Makeup', 'CoverageCream.jpeg'),
(13, 'Be Beautiful Luminous CC', 'THANK YOU FARMER', 'Give your skin a luminous glow with this SPF 30-fortified CC cream that corrects skin tone, making it look more even, lustrous and flawless while protecting it from skin darkening and aging.', 5, 34, 'Skincare', 'CorrectionCream.jpeg'),
(14, 'Clearing BB Cream', 'Purito', 'Healthy-Looking GlowFlawless CoverageEO & Fragrance FreeThis BB cream provides a natural and radiant finish, and strengthens the skin barrier. It gently absorbs into the skin and has a long-lasting formula. This product does not contain artificial fragrances, essential oils, and harmful ingredients, which can cause irritation, making it great for people with all skin types including sensitive skin.', 3, 120, 'Skincare', 'ClearingBBCream.jpeg'),
(15, 'Glow Tension SPF50+ PA+++', 'MISSHA', 'MISSHA Glow Tension SPF50+ PA+++ is available in 6 shades that create naturally plump, dewy skin. A tri-functional product: Anti-wrinkle + Whitening + UV Blocking. With Glow Moistension Complex that infused with amino acid, five kinds of hyaluronic acid, and collagen to prepare your skin for makeup. Perfect coverage provided by Micro Cover Poweder for flawless finish. Powerful adherence and consistency by Light-Fit Formula. How to use: Apply proper amount on a puff and pat lightly on the face.', 21, 22, 'Skincare', 'Foundation.jpeg'),
(16, 'Perfect Canvas Airpod Foundation', 'Temptu', 'Introducing a next-generation Perfect Canvas Foundation. Now with skin-nourishing natural ingredients, improved sprayability, advanced color payoff, and 24 shades for light-as-air, natural-looking coverage that lasts all day.', 4, 65, 'Makeup', 'Airbrush.jpg'),
(17, 'Mineral Multi-Master Bronzing Powder', 'MommyMakeUp', 'This Mineral Based PRESSED bronzer can be used on your face, eyes, and body!\r\nNo loose powder mess! Formulated without talc, gluten, phthalates, fragrance, GMO, parabens, or corn. It’s easy to blend formula allows you to start with a subtle golden glow, and build the color to a deeper, yet natural looking, tan, Talc-free, paraben-free, fragrance-free, noncomodegenic, cruelty-free, allergy tested. Made in USA.', 11, 32, 'Makeup', 'MommyMakeup.jpg'),
(18, 'All in one Make Up Kit ', 'Moobirlet', 'Contains multi-color matt eye shadow and glitter eye shadow, lip gloss, eyebrow cream, makeup pen, concealer, eye cream, etc., to meet your daily makeup needs. High quality ingredients with silky shine color, easy to blend and apply, creating clear and brilliant three-dimensional face makeup finish. Suitable for a variety of skin tones. Our cosmetics lasting color effect can be used for a long time. Long-lasting color effect, soft and comfortable texture, with high-quality brush, easy to create perfect makeup. With high-quality ingredients and silky luster, they can last all day. Waterproof and sweatproof. It is fully equipped and easy to carry. Complete girl/teen makeup, perfect gift set for holiday and Christmas gift idea for teen girls, gift for mom, gift for kids, gift for females and Holiday Christmas stocking stuffers', 23, 45, 'Makeup', 'MakeupKit.jpg'),
(19, 'Naked Wild West Eyeshadow Palette', 'Urban Decay', 'OUR MOST-WANTED NAKED - Urban Decay Naked Wild West Eyeshadow Palette features 12 desert-inspired neutrals, ranging from pale peach, warm bronze, and metallic silver to deep copper, blue-green matte, and soft turquoise shimmer.\r\nVEGAN HIGH-PIGMENT SHADES - This super-pigmented palette was inspired by California deserts, Joshua trees & endless skies. Shades include vegan Pony Up, Tex, Whiskey, Ghost Town, Rustler, Bud, Laredo, Cowboy Rick, Hold ’Em, Nudie, Spur & Standoff.\r\nBLAZE YOUR OWN TRAIL - Use the first six shades (from left to right) as allover base colors & transition shades. The six darker shades on the right are ideal for creating depth & dimension. Highlight the eye with the metallic & shimmer shades.\r\nPIGMENT INFUSION SYSTEM - Every shade in our paraben-free, sulfate-free, and phthalate-free eye shadow palettes features our proprietary ingredient blend that supplies velvety texture, rich color, and extreme blendability.\r\nPARTNERS IN CRIME - Try pairing your Naked Wild West Palette with these other Urban Decay products: Original Eyeshadow Primer Potion, Perversion Mascara, 24/7 Glide-On Eye Pencil, and All Nighter Makeup Setting Spray.', 12, 37.5, 'Makeup', 'Palette.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`CustomerId`),
  ADD UNIQUE KEY `PersonalCardId` (`CardNumber`);

--
-- Indexes for table `customerorder`
--
ALTER TABLE `customerorder`
  ADD PRIMARY KEY (`OrderId`),
  ADD KEY `CustomerId` (`CustomerId`);

--
-- Indexes for table `orderitem`
--
ALTER TABLE `orderitem`
  ADD PRIMARY KEY (`OrderItemId`),
  ADD KEY `ProductId` (`ProductId`),
  ADD KEY `OrderId` (`OrderId`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ProductId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `CustomerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customerorder`
--
ALTER TABLE `customerorder`
  MODIFY `OrderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `orderitem`
--
ALTER TABLE `orderitem`
  MODIFY `OrderItemId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `ProductId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customerorder`
--
ALTER TABLE `customerorder`
  ADD CONSTRAINT `customerorder_ibfk_1` FOREIGN KEY (`CustomerId`) REFERENCES `customer` (`CustomerId`);

--
-- Constraints for table `orderitem`
--
ALTER TABLE `orderitem`
  ADD CONSTRAINT `orderitem_ibfk_1` FOREIGN KEY (`OrderId`) REFERENCES `customerorder` (`OrderId`),
  ADD CONSTRAINT `orderitem_ibfk_2` FOREIGN KEY (`ProductId`) REFERENCES `product` (`ProductId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
