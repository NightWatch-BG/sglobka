--
-- Dumping data for table `address`
--

INSERT INTO `address` (`address_id`, `user_fk`, `email`, `phone`, `address`, `country_fk`, `city_fk`, `last_update`) VALUES
(1, 1, 'todor.mitovski@gmail.com', '0895602041', 'ul. Mihail Takev 13', 1, 2, '2016-07-20 19:36:40'),
(2, 2, 'todor.mitovski@gmail.com', '0895602042', 'bul. "Belomorski" 20', 1, 23, '2016-07-20 19:37:37');

-- --------------------------------------------------------

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`announcement_id`, `user_fk`, `title`, `announcement`, `announcement_date`) VALUES
(1, 1, 'Announcement 1', 'Announcement 1 111', '2016-07-20 19:48:01'),
(2, 2, 'Announcement 2 Announcement 2 Announcement 2A', 'Announcement 2 Announcement 2 Announcement 2 Announcement 2 Announcement 2 Announcement 2 Announcement 2 Announcement 2 Announcement 2 Announcement 2 Announcement 2 Announcement 2 Announcement 2 Announcement 2 Announcement 2 Announcement 2 Announcement 2 Announcement 2 Announcement 2 Announcement 2 Announcement 2 Announcement 2 Announcement 2', '2016-07-20 19:45:28'),
(4, 1, 'Announcement 3', 'Announcement 3 Announcement 3 Announcement 3', '2016-07-20 19:47:31');

-- --------------------------------------------------------

--
-- Dumping data for table `build_guide`
--

INSERT INTO `build_guide` (`build_guide_id`, `user_fk`, `title`, `guide`, `visibility_fk`, `last_update`, `in_order`) VALUES
(1, 1, 'TU1 Private Build', 'TU1 Private Build', 2, '2016-07-20 20:43:11', 0),
(2, 1, 'TU1 Public Build', 'TU1 Public Build', 1, '2016-07-20 20:43:45', 0),
(3, 2, 'TU2 Private Build', 'TU2 Private Build TU2 Private Build', 2, '2016-07-20 20:44:47', 0),
(4, 2, 'TU2 Public Build TU2 Public Build TU2 Public ', 'TU2 Public Build TU2 Public BuildTU2 Public Build TU2 Public Build TU2 Public Build TU2 Public Build TU2 Public Build TU2 Public Build TU2 Public Build TU2 Public BuildTU2 Public Build TU2 Public BuildTU2 Public Build TU2 Public BuildTU2 Public Build TU2 Public BuildTU2 Public Build TU2 Public BuildTU2 Public Build TU2 Public BuildTU2 Public Build TU2 Public BuildTU2 Public Build TU2 Public BuildTU2 Public Build TU2 Public BuildTU2 Public Build TU2 Public BuildTU2 Public Build TU2 Public BuildTU2 Public Build TU2 Public BuildTU2 Public Build TU2 Public Build', 1, '2016-07-20 20:50:21', 0),
(5, 3, 'TU3 Private Build', 'TU3 Private Build TU3 Private Build TU3 Private Build', 2, '2016-07-20 20:46:03', 0),
(6, 3, 'TU3 Public Build', 'TU3 Public Build TU3 Public Build TU3 Public Build', 1, '2016-07-20 20:46:33', 0);

-- --------------------------------------------------------

--
-- Dumping data for table `build_part`
--

INSERT INTO `build_part` (`build_part_id`, `build_guide_fk`, `part_fk`) VALUES
(1, 4, 1),
(2, 4, 21),
(3, 4, 42),
(4, 4, 62),
(5, 4, 81),
(6, 4, 121),
(7, 4, 101),
(8, 2, 1),
(9, 2, 21),
(10, 2, 42),
(11, 2, 62),
(12, 2, 81),
(13, 2, 125),
(14, 2, 101);

-- --------------------------------------------------------

