CREATE TABLE `facility_stock_out_tracker` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `facility_code` int(11) NOT NULL,
  `commodity_id` int(11) NOT NULL,
  `commodity_status` varchar(20) NOT NULL,
  `start_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `end_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_facility_stock_out_tracker_facility_code` (`facility_code`),
  KEY `idx_facility_stock_out_tracker_commodity_id` (`commodity_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1