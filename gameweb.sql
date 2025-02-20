-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Feb 20, 2025 at 10:48 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gameweb`
--

-- --------------------------------------------------------

--
-- Table structure for table `banned_words`
--

CREATE TABLE `banned_words` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `word` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `banned_words`
--

INSERT INTO `banned_words` (`id`, `word`, `created_at`, `updated_at`) VALUES
(3, 'Fuck', '2025-02-13 09:17:26', '2025-02-13 09:17:26'),
(4, 'Asshole', '2025-02-13 09:17:36', '2025-02-13 09:17:36');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `image` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title_cache` varchar(255) DEFAULT NULL,
  `content_cache` text DEFAULT NULL,
  `image_cache` text DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `content`, `image`, `created_at`, `updated_at`, `user_id`, `title_cache`, `content_cache`, `image_cache`, `status`) VALUES
(2, 'Trump đóng blog 12', '<p>Blog của Trump, nơi ông chia sẻ các tuyên bố với người ủng hộ sau khi bị cấm trên những mạng xã hội như Twitter và Facebook, đã bị đóng. Trump ra mắt trang blog \"Từ bàn làm việc của Donald Trump\" vào tháng trước để giao tiếp với người ủng hộ. Trang web hiện chỉ cho phép người dùng điền địa chỉ email và số điện thoại để đăng ký nhận thông tin cập nhật từ cựu tổng thống. Các nội dung đăng tải trước đây đã biến mất. Trump tại Washington ngày 13/6/2019. Ảnh: AFP. Trump tại Washington ngày 13/6/2019. Ảnh: AFP. Trợ lý cấp cao của Trump Jason Miller ngày 2/6 xác nhận với Hill rằng trang blog \"sẽ không quay trở lại\". \"Nó vốn chỉ là phần bổ trợ cho những nỗ lực rộng lớn hơn mà chúng tôi đã và đang thực hiện\", Miller nói. Hiện chưa rõ Trump sẽ theo đuổi những con đường nào khác để giao tiếp với người ủng hộ. Một loạt mạng xã hội phổ biến gồm Twitter và Facebook đã cấm tài khoản của Trump sau cuộc bạo loạn ở Đồi Capitol ngày 6/1. Tháng trước, Facebook thông báo lệnh cấm sẽ tiếp tục duy trì. Tuy nhiên, Hội đồng Giám sát Facebook cho rằng việc đình chỉ vô thời hạn là không phù hợp, họ kêu gọi Facebook xem xét lại quyết định và đưa ra \"phản ứng phù hợp\" trong vòng 6 tháng.</p>', 'img/SrDzaVHIGf4CXkwTArSVn0OSoiXK0ZCHEb1hRVp6.jpg', '2025-02-03 09:19:47', '2025-02-20 09:07:55', NULL, '', '', '', 0),
(3, 'Trump đóng blog', 'Blog của Trump, nơi ông chia sẻ các tuyên bố với người ủng hộ sau khi bị cấm trên những mạng xã hội như Twitter và Facebook, đã bị đóng.\r\n\r\nTrump ra mắt trang blog \"Từ bàn làm việc của Donald Trump\" vào tháng trước để giao tiếp với người ủng hộ. Trang web hiện chỉ cho phép người dùng điền địa chỉ email và số điện thoại để đăng ký nhận thông tin cập nhật từ cựu tổng thống. Các nội dung đăng tải trước đây đã biến mất.\r\n\r\nTrump tại Washington ngày 13/6/2019. Ảnh: AFP.\r\n\r\nTrump tại Washington ngày 13/6/2019. Ảnh: AFP.\r\n\r\nTrợ lý cấp cao của Trump Jason Miller ngày 2/6 xác nhận với Hill rằng trang blog \"sẽ không quay trở lại\". \"Nó vốn chỉ là phần bổ trợ cho những nỗ lực rộng lớn hơn mà chúng tôi đã và đang thực hiện\", Miller nói.\r\n\r\nHiện chưa rõ Trump sẽ theo đuổi những con đường nào khác để giao tiếp với người ủng hộ. Một loạt mạng xã hội phổ biến gồm Twitter và Facebook đã cấm tài khoản của Trump sau cuộc bạo loạn ở Đồi Capitol ngày 6/1.\r\n\r\nTháng trước, Facebook thông báo lệnh cấm sẽ tiếp tục duy trì. Tuy nhiên, Hội đồng Giám sát Facebook cho rằng việc đình chỉ vô thời hạn là không phù hợp, họ kêu gọi Facebook xem xét lại quyết định và đưa ra \"phản ứng phù hợp\" trong vòng 6 tháng.', NULL, '2025-02-03 09:20:10', '2025-02-03 09:20:10', NULL, '', '', '', 0),
(4, 'Trump đóng blog', 'Blog của Trump, nơi ông chia sẻ các tuyên bố với người ủng hộ sau khi bị cấm trên những mạng xã hội như Twitter và Facebook, đã bị đóng.\r\n\r\nTrump ra mắt trang blog \"Từ bàn làm việc của Donald Trump\" vào tháng trước để giao tiếp với người ủng hộ. Trang web hiện chỉ cho phép người dùng điền địa chỉ email và số điện thoại để đăng ký nhận thông tin cập nhật từ cựu tổng thống. Các nội dung đăng tải trước đây đã biến mất.\r\n\r\nTrump tại Washington ngày 13/6/2019. Ảnh: AFP.\r\n\r\nTrump tại Washington ngày 13/6/2019. Ảnh: AFP.\r\n\r\nTrợ lý cấp cao của Trump Jason Miller ngày 2/6 xác nhận với Hill rằng trang blog \"sẽ không quay trở lại\". \"Nó vốn chỉ là phần bổ trợ cho những nỗ lực rộng lớn hơn mà chúng tôi đã và đang thực hiện\", Miller nói.\r\n\r\nHiện chưa rõ Trump sẽ theo đuổi những con đường nào khác để giao tiếp với người ủng hộ. Một loạt mạng xã hội phổ biến gồm Twitter và Facebook đã cấm tài khoản của Trump sau cuộc bạo loạn ở Đồi Capitol ngày 6/1.\r\n\r\nTháng trước, Facebook thông báo lệnh cấm sẽ tiếp tục duy trì. Tuy nhiên, Hội đồng Giám sát Facebook cho rằng việc đình chỉ vô thời hạn là không phù hợp, họ kêu gọi Facebook xem xét lại quyết định và đưa ra \"phản ứng phù hợp\" trong vòng 6 tháng.', NULL, '2025-02-03 09:20:13', '2025-02-03 09:20:13', NULL, '', '', '', 0),
(5, 'Trump đóng blog', 'Blog của Trump, nơi ông chia sẻ các tuyên bố với người ủng hộ sau khi bị cấm trên những mạng xã hội như Twitter và Facebook, đã bị đóng.\r\n\r\nTrump ra mắt trang blog \"Từ bàn làm việc của Donald Trump\" vào tháng trước để giao tiếp với người ủng hộ. Trang web hiện chỉ cho phép người dùng điền địa chỉ email và số điện thoại để đăng ký nhận thông tin cập nhật từ cựu tổng thống. Các nội dung đăng tải trước đây đã biến mất.\r\n\r\nTrump tại Washington ngày 13/6/2019. Ảnh: AFP.\r\n\r\nTrump tại Washington ngày 13/6/2019. Ảnh: AFP.\r\n\r\nTrợ lý cấp cao của Trump Jason Miller ngày 2/6 xác nhận với Hill rằng trang blog \"sẽ không quay trở lại\". \"Nó vốn chỉ là phần bổ trợ cho những nỗ lực rộng lớn hơn mà chúng tôi đã và đang thực hiện\", Miller nói.\r\n\r\nHiện chưa rõ Trump sẽ theo đuổi những con đường nào khác để giao tiếp với người ủng hộ. Một loạt mạng xã hội phổ biến gồm Twitter và Facebook đã cấm tài khoản của Trump sau cuộc bạo loạn ở Đồi Capitol ngày 6/1.\r\n\r\nTháng trước, Facebook thông báo lệnh cấm sẽ tiếp tục duy trì. Tuy nhiên, Hội đồng Giám sát Facebook cho rằng việc đình chỉ vô thời hạn là không phù hợp, họ kêu gọi Facebook xem xét lại quyết định và đưa ra \"phản ứng phù hợp\" trong vòng 6 tháng.', NULL, '2025-02-03 09:20:16', '2025-02-03 09:20:16', NULL, '', '', '', 0),
(6, 'Trump đóng blog', '<p>Blog của Trump, nơi ông chia sẻ các tuyên bố với người ủng hộ sau khi bị cấm trên những mạng xã hội như Twitter và Facebook, đã bị đóng. Trump ra mắt trang blog \"Từ bàn làm việc của Donald Trump\" vào tháng trước để giao tiếp với người ủng hộ. Trang web hiện chỉ cho phép người dùng điền địa chỉ email và số điện thoại để đăng ký nhận thông tin cập nhật từ cựu tổng thống. Các nội dung đăng tải trước đây đã biến mất. Trump tại Washington ngày 13/6/2019. Ảnh: AFP. Trump tại Washington ngày 13/6/2019. Ảnh: AFP. Trợ lý cấp cao của Trump Jason Miller ngày 2/6 xác nhận với Hill rằng trang blog \"sẽ không quay trở lại\". \"Nó vốn chỉ là phần bổ trợ cho những nỗ lực rộng lớn hơn mà chúng tôi đã và đang thực hiện\", Miller nói. Hiện chưa rõ Trump sẽ theo đuổi những con đường nào khác để giao tiếp với người ủng hộ. Một loạt mạng xã hội phổ biến gồm Twitter và Facebook đã cấm tài khoản của Trump sau cuộc bạo loạn ở Đồi Capitol ngày 6/1. Tháng trước, Facebook thông báo lệnh cấm sẽ tiếp tục duy trì. Tuy nhiên, Hội đồng Giám sát Facebook cho rằng việc đình chỉ vô thời hạn là không phù hợp, họ kêu gọi Facebook xem xét lại quyết định và đưa ra \"phản ứng phù hợp\" trong vòng 6 tháng.</p>', 'img/Y5jNLhF59ieJZcJd9N9J7aL2J2FPEEvqDI4R8fN5.jpg', '2025-02-03 09:20:22', '2025-02-13 06:40:13', NULL, '', '', '', 0),
(8, 'Elon Musk \'được tiếp cận\' hệ thống 6.000 tỷ USD ngân sách chính phủ Mỹ', '<p>Ban tinh giản của Elon Musk chặn các khoản thanh toán cho nhà thầu liên bang, cho thấy ông đã được truy cập hệ thống quản lý ngân sách 6.000 tỷ USD.</p><p>\"Những khoản chi lãng phí và tham nhũng đang được loại bỏ theo thời gian thực\", tỷ phú Elon Musk, lãnh đạo Ban Hiệu suất Chính phủ Mỹ (DOGE), cho biết trong bài đăng trên X ngày 2/2. Musk cho biết các thành viên DOGE đang \"nhanh chóng phong tỏa\" những khoản thanh toán cho tổ chức từ thiện Lutheran.</p><p>Việc DOGE có thể can thiệp vào tiền thanh toán cho các nhà thầu liên bang cho thấy đội ngũ của Musk đã được cấp quyền truy cập vào Hệ thống Chi trả Liên bang (FPS), hệ thống quản lý ngân sách nhạy cảm được sử dụng tại Bộ Tài chính Mỹ.</p><p>FPS là một trong những hệ thống chứa thông tin nhạy cảm nhất của chính phủ Mỹ, kiểm soát hơn 6.000 tỷ USD ngân sách liên bang mỗi năm, đại diện chính phủ phân bổ tiền an sinh xã hội, phúc lợi y tế, lương công chức, tiền tài trợ và hợp đồng với các nhà thầu.</p><p>Hệ thống chứa dữ liệu cá nhân nhạy cảm của hàng triệu người dân Mỹ và nhà thầu các hợp đồng công cộng tại Mỹ, theo thông báo vào ngày 2/2 của nghị sĩ Ron Wyden, thành viên cấp cao trong Ủy ban Tài chính Thượng viện.</p><p><picture><source srcset=\"https://i1-vnexpress.vnecdn.net/2025/02/03/2024-12-10T182548Z-1658799844-6909-1793-1738565233.jpg?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=VuQze4DzVi1OoXj33Nez3g 1x, https://i1-vnexpress.vnecdn.net/2025/02/03/2024-12-10T182548Z-1658799844-6909-1793-1738565233.jpg?w=1020&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=qVdpLXk-QS09RHMBcz3COw 1.5x, https://i1-vnexpress.vnecdn.net/2025/02/03/2024-12-10T182548Z-1658799844-6909-1793-1738565233.jpg?w=680&amp;h=0&amp;q=100&amp;dpr=2&amp;fit=crop&amp;s=2k0NbOGFtEwNo3Mwwo1plw 2x\"><img src=\"https://i1-vnexpress.vnecdn.net/2025/02/03/2024-12-10T182548Z-1658799844-6909-1793-1738565233.jpg?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=VuQze4DzVi1OoXj33Nez3g\" alt=\"Tỷ phú Mỹ Elon Musk tại dinh thự Mar-a-Lago của Tổng thống Donald Trump vào hôm 5/1. Ảnh: Reuters\"></picture></p><p>Tỷ phú Mỹ Elon Musk tại dinh thự Mar-a-Lago của Tổng thống Donald Trump vào hôm 5/1. Ảnh: <i>Reuters</i></p><p>\"Ông Musk có thể tiếp cận toàn bộ thông tin về phúc lợi an sinh xã hội và bảo hiểm Medicare, quỹ tài trợ, nhà thầu chính phủ, trong đó có những đơn vị trực tiếp cạnh tranh với các công ty của ông ấy\", Wyden viết trên mạng xã hội Bluesky, mạng xã hội ra đời vào năm 2023 để cạnh tranh với X.</p>', 'img/QbmdQMYcptdaTYqvpPgPIexqMCcUZ23n4FmEnFLw.jpg', '2025-02-03 02:51:13', '2025-02-13 06:39:37', NULL, '', '', '', 0),
(9, 'Elon Musk \'được tiếp cận\' hệ thống 6.000 tỷ USD ngân sách chính phủ Mỹ', '<p>Ban tinh giản của Elon Musk chặn các khoản thanh toán cho nhà thầu liên bang, cho thấy ông đã được truy cập hệ thống quản lý ngân sách 6.000 tỷ USD.</p><p>\"Những khoản chi lãng phí và tham nhũng đang được loại bỏ theo thời gian thực\", tỷ phú Elon Musk, lãnh đạo Ban Hiệu suất Chính phủ Mỹ (DOGE), cho biết trong bài đăng trên X ngày 2/2. Musk cho biết các thành viên DOGE đang \"nhanh chóng phong tỏa\" những khoản thanh toán cho tổ chức từ thiện Lutheran.</p><p>Việc DOGE có thể can thiệp vào tiền thanh toán cho các nhà thầu liên bang cho thấy đội ngũ của Musk đã được cấp quyền truy cập vào Hệ thống Chi trả Liên bang (FPS), hệ thống quản lý ngân sách nhạy cảm được sử dụng tại Bộ Tài chính Mỹ.</p><p>FPS là một trong những hệ thống chứa thông tin nhạy cảm nhất của chính phủ Mỹ, kiểm soát hơn 6.000 tỷ USD ngân sách liên bang mỗi năm, đại diện chính phủ phân bổ tiền an sinh xã hội, phúc lợi y tế, lương công chức, tiền tài trợ và hợp đồng với các nhà thầu.</p><p>Hệ thống chứa dữ liệu cá nhân nhạy cảm của hàng triệu người dân Mỹ và nhà thầu các hợp đồng công cộng tại Mỹ, theo thông báo vào ngày 2/2 của nghị sĩ Ron Wyden, thành viên cấp cao trong Ủy ban Tài chính Thượng viện.</p><p><picture><source srcset=\"https://i1-vnexpress.vnecdn.net/2025/02/03/2024-12-10T182548Z-1658799844-6909-1793-1738565233.jpg?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=VuQze4DzVi1OoXj33Nez3g 1x, https://i1-vnexpress.vnecdn.net/2025/02/03/2024-12-10T182548Z-1658799844-6909-1793-1738565233.jpg?w=1020&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=qVdpLXk-QS09RHMBcz3COw 1.5x, https://i1-vnexpress.vnecdn.net/2025/02/03/2024-12-10T182548Z-1658799844-6909-1793-1738565233.jpg?w=680&amp;h=0&amp;q=100&amp;dpr=2&amp;fit=crop&amp;s=2k0NbOGFtEwNo3Mwwo1plw 2x\"><img src=\"https://i1-vnexpress.vnecdn.net/2025/02/03/2024-12-10T182548Z-1658799844-6909-1793-1738565233.jpg?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=VuQze4DzVi1OoXj33Nez3g\" alt=\"Tỷ phú Mỹ Elon Musk tại dinh thự Mar-a-Lago của Tổng thống Donald Trump vào hôm 5/1. Ảnh: Reuters\"></picture></p><p>Tỷ phú Mỹ Elon Musk tại dinh thự Mar-a-Lago của Tổng thống Donald Trump vào hôm 5/1. Ảnh: <i>Reuters</i></p><p>\"Ông Musk có thể tiếp cận toàn bộ thông tin về phúc lợi an sinh xã hội và bảo hiểm Medicare, quỹ tài trợ, nhà thầu chính phủ, trong đó có những đơn vị trực tiếp cạnh tranh với các công ty của ông ấy\", Wyden viết trên mạng xã hội Bluesky, mạng xã hội ra đời vào năm 2023 để cạnh tranh với X.</p>', 'img/Wf68DiELd8LAHj5YxaDKH88wy2U1X8wkSj5ekirs.jpg', '2025-02-03 02:53:10', '2025-02-03 02:53:10', NULL, '', '', '', 0),
(10, 'Vitamin A có nhiều trong phụ nữ?', '<p>Một người nước ngoài học tiếng Việt viết trên blog của mình:</p><p><picture><source srcset=\"https://i1-vnexpress.vnecdn.net/2018/06/07/6-responsavel-8840-1528354510.jpg?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=b34tuCTxxx547isABXba3A\"><img src=\"https://i1-vnexpress.vnecdn.net/2018/06/07/6-responsavel-8840-1528354510.jpg?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=b34tuCTxxx547isABXba3A\" alt=\"Vitamin A có nhiều trong phụ nữ?\"></picture></p><p>&nbsp;</p><p>Ai cũng biết rằng vitamin A cho ta đôi mắt sáng. Vitamin A có nhiều trong rau, củ, quả mang mầu đỏ như gấc, cà chua, cà rốt... Tuy nhiên ở Việt Nam theo nghiên cứu của cá nhân tôi thì trong rau, củ, quả chưa phải là nhiều. Đại đa số người Việt đều cho rằng, việc lấy vợ sẽ tăng cường đáng kể một lượng vitamin A cho mỗi chàng trai bởi lẽ trước khi lấy vợ các bậc cha mẹ của họ thường nói: \'Cứ lấy vợ đi rồi mày sẽ sáng mắt ra\'!</p><p>&nbsp;</p>', 'img/CB64cDTBHWY91Ij9lbzB88VW67QdrQT9dhkR7PrE.jpg', '2025-02-03 03:05:19', '2025-02-03 03:05:19', NULL, '', '', '', 0),
(11, 'Vitamin A có nhiều trong phụ nữ?', '<h2><strong>Vitamin A có nhiều trong phụ nữ?</strong></h2><p>Một người nước ngoài học tiếng Việt viết trên blog của mình:</p><p>&nbsp;</p><p><picture><source srcset=\"https://i1-vnexpress.vnecdn.net/2018/06/07/6-responsavel-8840-1528354510.jpg?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=b34tuCTxxx547isABXba3A\"><img src=\"https://i1-vnexpress.vnecdn.net/2018/06/07/6-responsavel-8840-1528354510.jpg?w=680&amp;h=0&amp;q=100&amp;dpr=1&amp;fit=crop&amp;s=b34tuCTxxx547isABXba3A\" alt=\"Vitamin A có nhiều trong phụ nữ?\"></picture></p><p>&nbsp;</p><p>Ai cũng biết rằng vitamin A cho ta đôi mắt sáng. Vitamin A có nhiều trong rau, củ, quả mang mầu đỏ như gấc, cà chua, cà rốt... Tuy nhiên ở Việt Nam theo nghiên cứu của cá nhân tôi thì trong rau, củ, quả chưa phải là nhiều. Đại đa số người Việt đều cho rằng, việc lấy vợ sẽ tăng cường đáng kể một lượng vitamin A cho mỗi chàng trai bởi lẽ trước khi lấy vợ các bậc cha mẹ của họ thường nói: \'Cứ lấy vợ đi rồi mày sẽ sáng mắt ra\'!</p>', 'img/YjPF5iMktSDuD9qJKFoel7Yt5GmoqBlwnxJOzr7n.jpg', '2025-02-13 06:43:16', '2025-02-13 06:43:16', 2, '', '', '', 0),
(12, 'Thử test xr,m', '<h2><strong>Apple bất ngờ ra mắt iPhone 16e với giá rẻ bất ngờ1</strong></h2><figure class=\"image\"><img src=\"https://cdn.tuoitre.vn/zoom/32_32/471584752817336320/2023/8/14/screenshot-2023-08-14-220312-1692025411519563676953.png\" alt=\"tác giả\"></figure><p><a href=\"https://tuoitre.vn/tac-gia/duc-thien-39180.htm\"><strong>ĐỨC THIỆN</strong></a></p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p><strong>Nghe đọc bài</strong></p><p>2:23</p><p>1x</p><p>&nbsp;</p><p>&nbsp;</p><figure class=\"image\"><img src=\"https://static-tuoitre.tuoitre.vn/tuoitre/web_images/banner_gg_news_v2.png\" alt=\"news google\"></figure><h2><strong>Apple cho biết iPhone 16e sở hữu hiệu năng nhanh của chip A18, Apple Intelligence, thời lượng pin vượt trội và hệ thống camera 48MP 2 trong 1, đặc biệt mức giá bất ngờ?</strong></h2><p><a href=\"https://cdn.tuoitre.vn/471584752817336320/2025/2/20/iphone-16e-apple-17400212006971611858743.jpg\"><img src=\"https://cdn.tuoitre.vn/thumb_w/730/471584752817336320/2025/2/20/iphone-16e-apple-17400212006971611858743.jpg\" alt=\"Apple bất ngờ ra mắt iPhone 16e với giá rẻ bất ngờ - Ảnh 1.\" srcset=\"https://cdn.tuoitre.vn/thumb_w/480/471584752817336320/2025/2/20/iphone-16e-apple-17400212006971611858743.jpg  480w,https://cdn.tuoitre.vn/thumb_w/800/471584752817336320/2025/2/20/iphone-16e-apple-17400212006971611858743.jpg 800w,https://cdn.tuoitre.vn/thumb_w/1200/471584752817336320/2025/2/20/iphone-16e-apple-17400212006971611858743.jpg 1200w\" sizes=\"100vw\" width=\"978\"></a></p><p>&nbsp;</p><p>Apple bất ngờ ra mắt iPhone 16e có giá bán rẻ nhất trong các phiên bản iPhone 16 - Ảnh: APPLE</p><p>Theo đó, <a href=\"https://tuoitre.vn/iphone-16.html\">iPhone 16e</a> được trang bị chip A18 thế hệ mới nhất của Apple, hỗ trợ hiệu năng nhanh, mượt mà, khả năng tiết kiệm điện và Apple Intelligence (trí tuệ nhân tạo Apple).</p>', 'img/VGH8cqu3HVOGIGwkoj3xR5lXdzl0CLjM4P7JPMJU.jpg', '2025-02-20 09:08:20', '2025-02-20 09:08:20', NULL, NULL, NULL, NULL, 1),
(13, 'Bán nhà Gò Vấp chính chủ, ngang 5m dài 14.5m, 72 m2, giá 6 tỷ123123', '<h2><strong>Bán nhà Gò Vấp chính chủ, ngang 5m dài 14.5m, 72 m2, giá 6 tỷ</strong></h2><p><strong>6 tỷ VND</strong></p><p>&nbsp;Lưu tin</p><p>Địa chỉ: 275/..., Phường 10, Quận Gò Vấp, Thành phố Hồ Chí Minh</p><p>Mô tả</p><p>Bán nhà Quang Trung Phường 10 Gò Vấp, ngang 5m x dài 14.5m, 72m2. Chính chủ đứng bán, giá yêu thương chỉ 6 tỷ đồng. Sổ hồng nghiêm chỉnh, không dính lộ giới quy hoạch. Sang tên công chứng nhanh gọn lẹ. Ban ngày đi làm ở Quận 3, nên xem nhà vui lòng hẹn trước. Zalo / Telegram / Messenger Facebook vô tư nhắn thoải mái. Hướng dẫn đường đi : ngã năm Chuồng Chó đi vào Quang Trung, chạy ngang qua siêu thị Vincom (bên tay phải) thì sẽ gặp hẻm 383 bên trái nha. Chúng ta chạy thẳng vào đó đi dọc theo ngã rẽ bên trái khúc đầu hẻm thẳng tới nhà. Hẻm 275 cắt ngang và rất dễ tìm, đi đường này là thẳng luôn. P/s : thời điểm này bỏ 6 tỷ vào đâu cho hiệu quả ? Bà con muốn tích lũy để dành cho mai sau thì cứ mua căn nhà trong hẻm này. Cam kết chỉ số lợi nhuận sau 03 năm sẽ ngon lành hơn bất kỳ kênh đầu tư nào khác.</p>', 'img/OE9rhds950QymCmI1UUB53LQ1UV3xTb2sdPIgAjU.jpg', '2025-02-20 09:22:44', '2025-02-20 09:43:11', 2, 'Bán nhà Gò Vấp chính chủ, ngang 5m dài 14.5m, 72 m2, giá 3 tỷ 1', '<h2><strong>Bán nhà Gò Vấp chính chủ, ngang 5m dài 14.5m, 72 m2, giá 6 tỷ</strong></h2><p><strong>6 tỷ VND</strong></p><p>&nbsp;Lưu tin</p><p>Địa chỉ: 275/..., Phường 10, Quận Gò Vấp, Thành phố Hồ Chí Minh</p><p>Mô tả</p><p>Bán nhà Quang Trung Phường 10 Gò Vấp, ngang 5m x dài 14.5m, 72m2. Chính chủ đứng bán, giá yêu thương chỉ 6 tỷ đồng. Sổ hồng nghiêm chỉnh, không dính lộ giới quy hoạch. Sang tên công chứng nhanh gọn lẹ. Ban ngày đi làm ở Quận 3, nên xem nhà vui lòng hẹn trước. Zalo / Telegram / Messenger Facebook vô tư nhắn thoải mái. Hướng dẫn đường đi : ngã năm Chuồng Chó đi vào Quang Trung, chạy ngang qua siêu thị Vincom (bên tay phải) thì sẽ gặp hẻm 383 bên trái nha. Chúng ta chạy thẳng vào đó đi dọc theo ngã rẽ bên trái khúc đầu hẻm thẳng tới nhà. Hẻm 275 cắt ngang và rất dễ tìm, đi đường này là thẳng luôn. P/s : thời điểm này bỏ 6 tỷ vào đâu cho hiệu quả ? Bà con muốn tích lũy để dành cho mai sau thì cứ mua căn nhà trong hẻm này. Cam kết chỉ số lợi nhuận sau 03 năm sẽ ngon lành hơn bất kỳ kênh đầu tư nào khác.</p>', 'img/OE9rhds950QymCmI1UUB53LQ1UV3xTb2sdPIgAjU.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `content` text NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `blog_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `like_count` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `content`, `user_id`, `blog_id`, `created_at`, `updated_at`, `like_count`) VALUES
(1, 'Ok ông Trump', 2, 6, '2025-02-13 08:47:53', '2025-02-13 09:08:47', 2),
(2, '1231312', 2, 6, '2025-02-13 08:52:10', '2025-02-13 09:05:56', 1);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `comment_id` bigint(20) UNSIGNED DEFAULT NULL,
  `reply_id` bigint(20) UNSIGNED DEFAULT NULL,
  `blog_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_02_02_164556_create_blogs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `replies`
--

CREATE TABLE `replies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `content` text NOT NULL,
  `comment_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `like_count` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `replies`
--

INSERT INTO `replies` (`id`, `content`, `comment_id`, `user_id`, `created_at`, `updated_at`, `like_count`) VALUES
(3, 'Ông Trump cảm ơn cháu nhé', 1, 1, '2025-02-13 09:28:56', '2025-02-13 09:28:56', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('O5Ia3NFeECWOmCWCQASPyNbnhHKFoqwGBPolstcg', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVmtXUDBrTWNQdmRqNGlqY2ZBU3RMQkVCbmI5NE5nQWJXN1B4eUxoUiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9ibG9ncyI7fX0=', 1738655593);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, '123', NULL, NULL, NULL, 1),
(2, 'Nguyễn Văn An', 'nva@gmail.com', NULL, '123', NULL, NULL, NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banned_words`
--
ALTER TABLE `banned_words`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_id` (`user_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `blog_id` (`blog_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `like_unique` (`user_id`,`comment_id`),
  ADD UNIQUE KEY `like_reply_unique` (`user_id`,`reply_id`),
  ADD KEY `likes_comment_id_foreign` (`comment_id`),
  ADD KEY `likes_reply_id_foreign` (`reply_id`),
  ADD KEY `likes_blog_id_foreign` (`blog_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `replies`
--
ALTER TABLE `replies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comment_id` (`comment_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banned_words`
--
ALTER TABLE `banned_words`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `replies`
--
ALTER TABLE `replies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blogs`
--
ALTER TABLE `blogs`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`blog_id`) REFERENCES `blogs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_blog_id_foreign` FOREIGN KEY (`blog_id`) REFERENCES `blogs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `likes_comment_id_foreign` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `likes_reply_id_foreign` FOREIGN KEY (`reply_id`) REFERENCES `replies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `likes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `replies`
--
ALTER TABLE `replies`
  ADD CONSTRAINT `replies_ibfk_1` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `replies_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
