-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2022 at 12:24 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skincareshopdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `CustomerId` int(11) NOT NULL,
  `Username` varchar(50) DEFAULT NULL,
  `PersonalCardId` int(11) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Passwrd` varchar(50) DEFAULT NULL,
  `FirstName` varchar(50) DEFAULT NULL,
  `LastName` varchar(50) DEFAULT NULL,
  `Address` varchar(50) DEFAULT NULL,
  `PostalCode` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orderitem`
--

CREATE TABLE `orderitem` (
  `OrderItemId` int(11) NOT NULL,
  `CustomerId` int(11) DEFAULT NULL,
  `ProductId` int(11) DEFAULT NULL,
  `OrderDate` date DEFAULT NULL,
  `RequestedDate` date DEFAULT NULL,
  `ShipDate` date DEFAULT NULL,
  `OrderState` varchar(15) DEFAULT NULL,
  `QuantityOrdered` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orderpayment`
--

CREATE TABLE `orderpayment` (
  `OrderPaymentId` int(11) NOT NULL,
  `CustomerId` int(11) DEFAULT NULL,
  `OrderItemId` int(11) DEFAULT NULL,
  `PaymentDate` date DEFAULT NULL,
  `TotalAmount` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `Photos` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ProductId`, `ProductName`, `ProductBrand`, `ProductDescription`, `QuantityAvailable`, `Price`, `Category`, `Photos`) VALUES
(1, 'Body Mist', 'Dare Deep', 'Body mist perfect for every age. Unique body spray lotion with hyaluronic acid, sunflower seed oil, and vitamins B5 and E intensely hydrates skin for 48 hours. Exclusive HydroSensitiv Complex™ with soothing blue daisy deepens dynamic hydration and soothes skin to improve the quality of sensitive skin over time .', 5, 19, 'Body', 'BodyMist.jpeg'),
(2, 'Aromatica Scalp Scaling Shampoo', 'Rosemary', 'Frequent hair styling such as dyeing, perming, and drying damages hair and weakens your scalp. Rosemary 3-in-1 treatment not only intensively nourishes hair but also adds shine and softness to your hair. 3-in-1 multi care is the right solution to damaged hair troubles.', 7, 23, 'Hair', 'Aromatica.jpeg'),
(3, 'Hyaluronic Acid Watery Sun Gel SPF 50+', 'ISNTREE', '8 Types of Hyaluronic Acid, Strong Protection Against UVA and UVB Rays, No White Cast, Reef-safe, Non-nano Sunscreen. With a great rating of 4.5 out of 5.', 15, 26, 'Body', 'Sunscream.jpeg'),
(4, 'Wonder Bubble Shampoo', 'LA\'DOR', 'Rich and refined foaming shampoo contains seven kinds of peptide extracted from soybean to strengthen and nourish hair and scalp, leaving hair clean, soft, bouncy and voluminous.\r\n', 5, 23, 'Hair', 'BubbleShampoo.jpeg'),
(5, 'Anti Dandruff Shampoo', 'LA\'DOR', 'Boasts a blend of herbal extracts to nourish hair and scalp, salicylic acid to remove dead skin cells as well as menthol to soothe and freshen up scalp. Its herbal-scented formula soothes the senses while thoroughly cleansing your locks and scalp – providing hydration and protection as well as banishing itchiness.', 11, 32, 'Hair', 'AntiDandruff.jpeg'),
(6, 'Keratin LPP Repair Shampoo', 'LA\'DOR', 'Nourishing Sub-acid Shampoo pH 6.0 Dry Damaged Colored Permed Hair Thinning Hair No Silicone No Harmful Ingredients, with Wheat Protein Silk Protein. ', 8, 26, 'Hair', 'KeratinShampoo.jpeg'),
(7, 'Centella Unscented Serum', 'Purito', 'This serum rejuvenates the skin by strengthening its barrier. It contains essential Centella ingredients to restore a damaged skin barrier and soothe irritated skin. The Centella Asiatica Extract and Panthenol help calm the irritated skin preventing further inflammation. If your skin is stressed using too many products with various ingredients that do not fit your skin, give your face a break and help it restore by using the Centella Unscented Serum.', 3, 18, 'Skincare', 'Serum.jpeg'),
(8, 'Green Deep Foaming Cleanser', 'Purito', 'This cleanser is formulated with natural ingredients and does not contain chemical surfactants such as SLS and SLES, which can cause irritation, making it great for people with all skin types including sensitive skin. It leaves the skin moisturized after cleansing and is great for morning and nighttime use. Keeping skin\'s acid mantle at the optimal pH of 5.5, this cleanser protects the skin barrier. Keeping skin\'s acid mantle at the optimal pH of 5.5, this cleanser protects the skin barrier.', 32, 12, 'Skincare', 'FoamingCleanser.jpeg'),
(9, 'Anti-Yellow Shampoo ', 'LA\'DOR', 'POTENT PURPLE PIGMENT - Using the Complementary Color Principle, the yellowing that happens to ly colored/bleached hair is controlled with purple pigments. STRONG ON HAIR, MINIMUM STAIN ON SKIN - Potent pigments are important for the anti-yellowing effect to take place, but you\'ll also want to be careful not to stain your skin. The special formulation makes this less staining than other shampoos out there. MOISTURIZING WITH COLOR PRESERVATION - Fighting against the yellowing with pigments is a great start, but hair that has been dyed and/or bleached need more care than that. This shampoo is also designed to help impart moisture at the same time.', 13, 24, 'Hair', 'AntiYellowShampoo.jpeg'),
(10, 'Black Bean Anti Hair Loss Shampoo', 'Nature Republic', 'NATURAL INGREDIENTS: The main ingredient of Nature Republic Black Bean Anti Hair Loss Shampoo is black beans that are great plant-based source of protein, which is essential to hair growth. Black beans are good source of zinc, which aids the hair growth and repair cycle. Also beans provide many other hair-healthy nutrients, including iron, biotin and folate.', 23, 18, 'Hair', 'AntiHairLoss.jpeg'),
(11, 'Cicapair Re-Cover', 'Dr. Jart++', 'mineral solution and panthenol strengthen natural skin force. Strawberry leaf extracts alleviate skin irritation and protect the skin from external harmful stimuli and environment. Formulated WITHOUT Parabens, Sulfates, Phthalates. Green-to-Beige color change texture represents healthy skin by covering the skin turned red due to stress. Formulated WITHOUT Parabens, Sulfates, Phthalates', 2, 45, 'Body', 'FaceCream.jpeg'),
(12, 'PERFECT COVER BB CREAM ', 'MISSHA M', 'FLAWLESS COVERAGE: Smoothly conceals imperfections, balances skin tone, and visibly smooths complexion for a youthfully perfected look. DEWY AND MOISTURIZING: Keeps your skin hydrated and soft with powerful ceramides, hyaluronic acid, and Gatuline RC. NATURALLY CONDITIONING: Infused with nourishing botanical essences, emollient plant oils, and nutrient rich marine extracts to replenish the look and feel of skin. GATULINE RC, HYALURONIC ACID, CERAMID: Help infuse moisture for firmer looking skin with reduction in appearance of fine lines & wrinkles. ROSEMARY AND CHAMOMILE EXTRACTS: Fragrant herbal botanical that help the complexion appear calm and balanced', 4, 58, 'Make Up', 'CoverageCream.jpeg'),
(13, 'Be Beautiful Luminous CC', 'THANK YOU FARMER', 'Give your skin a luminous glow with this SPF 30-fortified CC cream that corrects skin tone, making it look more even, lustrous and flawless while protecting it from skin darkening and aging.', 5, 34, 'Skincare', 'CorrectionCream.jpeg'),
(14, 'Clearing BB Cream', 'Purito', 'Healthy-Looking GlowFlawless CoverageEO & Fragrance FreeThis BB cream provides a natural and radiant finish, and strengthens the skin barrier. It gently absorbs into the skin and has a long-lasting formula. This product does not contain artificial fragrances, essential oils, and harmful ingredients, which can cause irritation, making it great for people with all skin types including sensitive skin.', 2, 120, 'Skincare', 'ClearingBBCream.jpeg'),
(15, 'Glow Tension SPF50+ PA+++', 'MISSHA', 'MISSHA Glow Tension SPF50+ PA+++ is available in 6 shades that create naturally plump, dewy skin. A tri-functional product: Anti-wrinkle + Whitening + UV Blocking. With Glow Moistension Complex that infused with amino acid, five kinds of hyaluronic acid, and collagen to prepare your skin for makeup. Perfect coverage provided by Micro Cover Poweder for flawless finish. Powerful adherence and consistency by Light-Fit Formula. How to use: Apply proper amount on a puff and pat lightly on the face.', 21, 22, 'Skincare', 'Foundation.jpeg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`CustomerId`),
  ADD UNIQUE KEY `PersonalCardId` (`PersonalCardId`),
  ADD UNIQUE KEY `Passwrd` (`Passwrd`);

--
-- Indexes for table `orderitem`
--
ALTER TABLE `orderitem`
  ADD PRIMARY KEY (`OrderItemId`),
  ADD KEY `CustomerId` (`CustomerId`),
  ADD KEY `ProductId` (`ProductId`);

--
-- Indexes for table `orderpayment`
--
ALTER TABLE `orderpayment`
  ADD PRIMARY KEY (`OrderPaymentId`),
  ADD KEY `CustomerId` (`CustomerId`),
  ADD KEY `OrderItemId` (`OrderItemId`);

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
  MODIFY `CustomerId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orderitem`
--
ALTER TABLE `orderitem`
  MODIFY `OrderItemId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orderpayment`
--
ALTER TABLE `orderpayment`
  MODIFY `OrderPaymentId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `ProductId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orderitem`
--
ALTER TABLE `orderitem`
  ADD CONSTRAINT `OrderItem_ibfk_1` FOREIGN KEY (`CustomerId`) REFERENCES `customer` (`CustomerId`),
  ADD CONSTRAINT `OrderItem_ibfk_2` FOREIGN KEY (`ProductId`) REFERENCES `product` (`ProductId`);

--
-- Constraints for table `orderpayment`
--
ALTER TABLE `orderpayment`
  ADD CONSTRAINT `OrderPayment_ibfk_1` FOREIGN KEY (`CustomerId`) REFERENCES `customer` (`CustomerId`),
  ADD CONSTRAINT `OrderPayment_ibfk_2` FOREIGN KEY (`OrderItemId`) REFERENCES `orderitem` (`OrderItemId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
