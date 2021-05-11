
CREATE DATABASE IF NOT EXISTS `db_contact` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `db_contact`;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contact`
--

DROP TABLE IF EXISTS `tbl_feedbacks`;
CREATE TABLE IF NOT EXISTS `tbl_feedbacks` (
                                             `id` int(11) NOT NULL,
                                             `fldEmail` varchar(100) NOT NULL,
                                             `fldType` varchar(17) NOT NULL,
                                             `fldMessage` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_contact`
--
ALTER TABLE `tbl_feedbacks`
    ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_contact`
--
ALTER TABLE `tbl_feedbacks`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;