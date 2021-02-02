-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 02, 2021 at 09:38 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `iubat`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `fullname`, `password`, `email`, `contact`) VALUES
(1, 'Admin3', 'Mr.Admin3', '5fb6e2a60c9da41e0a94fe6157ddb93f', 'admin3@gmail.com', '9999999'),
(2, 'admin', 'admin', '5fb6e2a60c9da41e0a94fe6157ddb93f', 'admin@gmail.com', '099343'),
(5, 'admin4', 'admin4', '5fb6e2a60c9da41e0a94fe6157ddb93f', 'admin4@gmail.com', '01787232112');

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) NOT NULL,
  `primaryemail` varchar(100) NOT NULL,
  `primaryemailcc` varchar(100) NOT NULL,
  `secondaryemail` varchar(100) NOT NULL,
  `secondaryemailcc` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `registrationtime` timestamp NOT NULL DEFAULT current_timestamp(),
  `reviewerselection` int(11) DEFAULT NULL,
  `editorselection` int(11) DEFAULT NULL,
  `validation_code` varchar(255) NOT NULL,
  `activation` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`id`, `username`, `title`, `firstname`, `middlename`, `lastname`, `primaryemail`, `primaryemailcc`, `secondaryemail`, `secondaryemailcc`, `password`, `contact`, `address`, `registrationtime`, `reviewerselection`, `editorselection`, `validation_code`, `activation`) VALUES
(5, 'nasim92', 'Dr.', 'Md.', 'John', 'Doe', 'mdnasim6416@gmail.com', 'admin@gmail.com', 'sdfsf@gmail.com', 'mdnasim6416@gmail.com', '5fb6e2a60c9da41e0a94fe6157ddb93f', '+8801755706416', 'Dhaka', '2020-12-25 04:28:24', 1, 1, '0', 1),
(6, 'Author2', 'Dr.', 'Author2', 'Islam', 'Khan', 'author2@gmail.com', 'Author4@gmail.com', 'author2@gmail.com', 'mdnasim6416@gmail.com', '5fb6e2a60c9da41e0a94fe6157ddb93f', '01787232112', 'Khulna', '2020-12-25 06:23:18', 1, 1, '0', 1),
(7, 'engr32', 'Engr', 'Ali', 'Ahmad', 'Iqbal', 'ali@gmail.com', 'ali1@gmail.com', 'ali2@gmail.com', 'ali2@gmail.com', '5fb6e2a60c9da41e0a94fe6157ddb93f', '01787232112', 'khulna', '2021-01-10 10:44:30', 1, NULL, '0', 1),
(12, 'Author40', 'Engr', 's', 's', 'a', '17203056@iubat.edu', '17203056@iubat.edu', '17203056@iubat.edu', 'mdnasim6416@gmail.com', '5fb6e2a60c9da41e0a94fe6157ddb93f', '01787232112223', 'Khulna', '2021-01-28 07:54:12', 0, 1, '0', 1),
(16, 'halim', 'DDDDD', 'Halim', 'Mondol', 'HALIM', 'mdnasimiubat@gmail.com', 'mdnasimiubat@gmail.com', 'mdnasimiubat@gmail.com', 'mdnasimiubat@gmail.com', '5fb6e2a60c9da41e0a94fe6157ddb93f', '01726274092', 'Khulna', '2021-01-31 04:58:08', 1, 1, '0', 1);

-- --------------------------------------------------------

--
-- Table structure for table `editortable`
--

CREATE TABLE `editortable` (
  `id` int(11) NOT NULL,
  `paperid` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `primaryemail` varchar(100) DEFAULT NULL,
  `assigndate` int(100) DEFAULT NULL,
  `assignmonth` int(100) DEFAULT NULL,
  `assignyear` int(100) DEFAULT NULL,
  `endingdate` int(100) DEFAULT NULL,
  `endingmonth` int(100) DEFAULT NULL,
  `endingyear` int(100) DEFAULT NULL,
  `feedback` varchar(8000) DEFAULT NULL,
  `feedbackdate` int(100) DEFAULT NULL,
  `feedbackmonth` int(100) DEFAULT NULL,
  `feedbackyear` int(100) DEFAULT NULL,
  `action` int(11) DEFAULT NULL,
  `accepted` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `editortable`
--

INSERT INTO `editortable` (`id`, `paperid`, `username`, `primaryemail`, `assigndate`, `assignmonth`, `assignyear`, `endingdate`, `endingmonth`, `endingyear`, `feedback`, `feedbackdate`, `feedbackmonth`, `feedbackyear`, `action`, `accepted`) VALUES
(23, '17', 'nasim92', 'mdnasim6416@gmail.com', 12, 1, 2021, NULL, NULL, NULL, 'Nice work', 19, 1, 2021, NULL, NULL),
(24, '63', 'nasim92', 'mdnasim6416@gmail.com', 14, 1, 2021, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `paper`
--

CREATE TABLE `paper` (
  `id` int(100) NOT NULL,
  `paperid` varchar(255) DEFAULT NULL,
  `authoremail` varchar(100) NOT NULL,
  `papername` varchar(255) NOT NULL,
  `numberofcoauthor` int(11) DEFAULT NULL,
  `abstract` varchar(8000) NOT NULL,
  `name` varchar(255) NOT NULL,
  `name1` varchar(255) NOT NULL,
  `name2` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `type1` varchar(255) NOT NULL,
  `type2` varchar(255) NOT NULL,
  `action` int(11) DEFAULT NULL,
  `pdate` int(11) DEFAULT NULL,
  `pmonth` int(11) DEFAULT NULL,
  `pyear` int(11) DEFAULT NULL,
  `uploaddate` int(100) DEFAULT NULL,
  `uploadmonth` int(100) DEFAULT NULL,
  `uploadyear` int(100) DEFAULT NULL,
  `coauthorname` varchar(1000) NOT NULL,
  `coauthoremail` varchar(1000) NOT NULL,
  `coauthordept` varchar(1000) NOT NULL,
  `coauthorinstitute` varchar(1000) NOT NULL,
  `coauthoraddress` varchar(1000) NOT NULL,
  `resubmitpaper` varchar(255) DEFAULT NULL,
  `resubmitdate` int(100) DEFAULT NULL,
  `resubmitmonth` int(100) DEFAULT NULL,
  `resubmityear` int(100) DEFAULT NULL,
  `reject` int(100) DEFAULT NULL,
  `rejectdate` int(100) DEFAULT NULL,
  `rejectmonth` int(100) DEFAULT NULL,
  `rejectyear` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `paper`
--

INSERT INTO `paper` (`id`, `paperid`, `authoremail`, `papername`, `numberofcoauthor`, `abstract`, `name`, `name1`, `name2`, `type`, `type1`, `type2`, `action`, `pdate`, `pmonth`, `pyear`, `uploaddate`, `uploadmonth`, `uploadyear`, `coauthorname`, `coauthoremail`, `coauthordept`, `coauthorinstitute`, `coauthoraddress`, `resubmitpaper`, `resubmitdate`, `resubmitmonth`, `resubmityear`, `reject`, `rejectdate`, `rejectmonth`, `rejectyear`) VALUES
(15, 'I2021015', 'mdnasim6416@gmail.com', 'Plant wealth of Lal-Bagh, Bangalore, Horticulture department', NULL, 'Nature is the international weekly journal of science: a magazine style journal that publishes full-length research papers in all disciplines of science, as well as News and Views, reviews, news, features, commentaries, web focuses and more, covering all branches of science and how science impacts upon all aspects of society and life.', 'plant-wealth-fruits.pdf', '', '', 'application/pdf', '', '', 1, 1, 2, 2020, 21, 11, 2020, '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 'I2021016', 'mdnasim6416@gmail.com', 'Student to career', NULL, 'I recommend Susan of Student to Career to help your child if they are struggling to find their place in the world and what their next steps should be. The testing is complete and detailed. It gives a very accurate picture of the child’s strengths and how they can be enhanced and applied in practical and exciting ways. However, even better than the report is the value that Susan provides. I found her to be dedicated and invested in my son’s progress.  The results we found, we could not have come up with by ourselves. I am grateful that we went through this process.', 'Student Career Research Paper.pdf', '', '', 'application/pdf', '', '', 0, 0, 0, 0, 21, 11, 2020, '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 'I2021017', 'mdnasim6416@gmail.com', 'Closed environments facilitate secondary transmission of coronavirus disease 2019 (COVID-19)', NULL, 'Commissioned by the Minister of the Ministry of Health, Labour, and Welfare of Japan, we collected secondary transmission data with the aim of identifying high risk transmission settings. We show that closed environments contribute to secondary transmission of COVID-19 and promote superspreading events. Closed environments are consistent with large-scale COVID-19 transmission events such as that of the ski chalet-associated cluster in France and the church- and hospital-associated clusters in South Korea. Our findings are also consistent with the declining incidence of COVID-19 cases in China, as gathering in closed environments was prohibited in the wake of the rapid spread of the disease. Reduction of unnecessary close contact in closed environments may help prevent large case clusters and superspreading events.', 'covid-19.pdf', '', '', 'application/pdf', '', '', 1, 2, 2, 2021, 2, 11, 2020, '', '', '', '', '', 'Practicum Student List Spring 2021.pdf', 2, 2, 2021, NULL, NULL, NULL, NULL),
(18, 'I2021018', 'mdnasim6416@gmail.com', 'Presumed Asymptomatic Carrier Transmission of COVID-19', NULL, 'In January 2020, we enrolled a familial cluster of 5 patients with fever and respiratory symptoms who were admitted to the Fifth People’s Hospital of Anyang, Anyang, China, and 1 asymptomatic family member. This study was approved by the local institutional review board, and written informed consent was obtained from all patients. A detailed analysis of patient records was performed.\r\n\r\nAll patients underwent chest CT imaging. Real-time reverse transcriptase polymerase chain reaction (RT-PCR) tests for COVID-19 nucleic acid were performed using nasopharyngeal swabs (Novel Coronavirus PCR Fluorescence Diagnostic Kit, BioGerm Medical Biotechnology).', 'jama_bai_2020_ld_200013.pdf', '', '', 'application/pdf', '', '', 1, 2, 2, 2021, 2, 11, 2020, '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 'I2021019', 'mdnasim6416@gmail.com', 'Dysregulation of Immune Response in Patients With Coronavirus 2019 (COVID-19) in Wuhan, China', NULL, 'Of the 452 patients with COVID-19 recruited, 286 were diagnosed as having severe infection. The median age was\r\n58 years and 235 were male. The most common symptoms were fever, shortness of breath, expectoration, fatigue, dry cough, and myalgia. Severe cases tend to have lower lymphocyte counts, higher leukocyte counts and neutrophil-lymphocyte ratio (NLR), as well\r\nas lower percentages of monocytes, eosinophils, and basophils. Most severe cases demonstrated elevated levels of infection-related\r\nbiomarkers and inflammatory cytokines. The number of T cells significantly decreased, and were more impaired in severe cases.\r\nBoth helper T (Th) cells and suppressor T cells in patients with COVID-19 were below normal levels, with lower levels of Th cells in\r\nthe severe group. The percentage of naive Th cells increased and memory Th cells decreased in severe cases. Patients with COVID-19\r\nalso have lower levels of regulatory T cells, which are more obviously decreased in severe cases.', 'ciaa248.pdf', '', '', 'application/pdf', '', '', 1, 9, 1, 2021, 2, 10, 2020, '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 'I2021020', 'author2@gmail.com', 'TGF-β in progression of liver disease', NULL, 'Transforming growth factor-β (TGF-β) is a central regulator in chronic liver disease contributing to all stages of disease progression from initial liver injury through inflammation and fibrosis to cirrhosis and hepatocellular carcinoma. Liver-damage-induced levels of active TGF-β enhance hepatocyte destruction and mediate hepatic stellate cell and fibroblast activation resulting in a wound-healing response, including myofibroblast generation and extracellular matrix deposition. Being recognised as a major profibrogenic cytokine, the targeting of the TGF-β signalling pathway has been explored with respect to the inhibition of liver disease progression. Whereas interference with TGF-β signalling in various short-term animal models has provided promising results, liver disease progression in humans is a process of decades with different phases in which TGF-β or its targeting might have both beneficial and adverse outcomes. Based on recent literature, we summarise the cell-type-directed double-edged role of TGF-β in various liver disease stages. We emphasise that, in order to achieve therapeutic effects, we need to target TGF-β signalling in the right cell type at the right time.', 'Dooley-Dijke2012_Article_TGF-βInProgressionOfLiverDisea.pdf', '', '', 'application/pdf', '', '', 0, 0, 0, 0, 12, 12, 2020, '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 'I2021021', 'author2@gmail.com', 'Fibrosis and Disease Progression in Hepatitis C ', NULL, 'The progression of fibrosis in chronic hepatitis C determines the ultimate prognosis and thus\r\nthe need and urgency of therapy. Fibrogenesis is a complex dynamic process, which is\r\nmediated by necroinflammation and activation of stellate cells. The liver biopsy remains the\r\ngold standard to assess fibrosis. Scoring systems allow a semiquantitative assessment and are\r\nuseful for cross-sectional and cohort studies and in treatment trials. The rate at which fibrosis\r\nprogresses varies markedly between patients. The major factors known to be associated with\r\nfibrosis progression are older age at infection, male gender, and excessive alcohol consumption. Viral load and genotype do not seem to influence significantly the progression rate.\r\nProgression of fibrosis is more rapid in immunocompromised patients. Hepatic steatosis,\r\nobesity, and diabetes may also contribute to more rapid progression of fibrosis. There are no\r\ntests that reliably predict the rate of progression of fibrosis in an individual patient. High\r\nserum alanine aminotransferase (ALT) levels are associated with a higher risk of fibrosis\r\nprogression, and worsening of fibrosis is uncommon in patients with persistently normal\r\nserum aminotransferase levels. Serum markers for fibrosis are not reliable and need to be\r\nimproved and validated. Liver biopsy provides the most accurate information on the stage of\r\nfibrosis and grade of necroinflammation, both of which have prognostic significance. Repeating the liver biopsy, 3 to 5 years after an initial biopsy is the most accurate means of\r\nassessing the progression of fibrosis. (HEPATOLOGY 2002;36:S47-S56.) ', 'hep.1840360707.pdf', '', '', 'application/pdf', '', '', 1, 2, 3, 2020, 11, 9, 2020, '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, 'I2021023', 'mdnasim6416@gmail.com', 'Reporting results of cancer treatment', NULL, 'On the initiative of the World Health Organization, two meetings on the Standardization of Reporting Results of Cancer Treatment have been held with representatives and members of several organizations. Recommendations have been developed for standardized approaches to the recording of baseline data relating to the patient, the tumor, laboratory and radiologic data, the reporting of treatment, grading of acute and subacute toxicity, reporting of response, recurrence and disease‐free interval, and reporting results of therapy. These recommendations, already endorsed by a number of organizations, are proposed for international acceptance and use to make it possible for investigators to compare validly their results with those of others.', '1097-0142(19810101)47_1_207__AID-CNCR2820470134_3.0.CO;2-6.pdf', '', '', 'application/pdf', '', '', 1, 4, 5, 2020, 21, 11, 2020, '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(63, 'I2021063', 'mdnasim6416@gmail.com', 'Influence Of Electronic Word Of Mouth eWOM On Purchase Intention', 4, 'Introduction of Web 2.0 technology shifted from conventional Word of mouth to electronic/online word of mouth ewe. The growth of social\r\nmedia and social media usage connect online user to create and share the user generated content. ewe convey the content created by user in\r\norganic form. The increasing popularity of various social network sites connect online user to share electronic word of mouth globally. The advancement\r\nof ewe information plays a vital role in consumer buying decision or purchase intention. Online user likes to create and share information about the\r\nproduct to help another user. Social media users seek information about product/ services before making purchase decision. Internet user trust other\r\nuser reviews, recommendation before making buying decision. Sharing information via Electronic word of mouth (ewe) in social media has positive\r\ninfluence on Purchase Intention. Brand awareness and trust are connected with Purchase Intention. In this paper various existing literature review are\r\nstudied to frame a proposed conceptual framework.', 'Influence-Of-Electronic-Word-Of-Mouth-Ewom-On-Purchase-Intention.pdf', '', '', 'application/pdf', '', '', 0, NULL, NULL, NULL, 2, 11, 2020, '', '', '', '', '', '', NULL, NULL, NULL, 1, 2, 2, 2021),
(70, 'I2021070', 'mdnasim6416@gmail.com', 'test', 1, 'tests', '158.pdf', '000000.pdf', 'Practicum Student List Spring 2021.pdf', 'application/pdf', 'application/pdf', 'application/pdf', 0, NULL, NULL, NULL, 2, 4, 2020, '17203056@iubat.edu                             ', '17203056@iubat.edu                             ', '2323                             ', 'as                             ', 'Khulna                             ', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(72, 'I2021072', 'mdnasim6416@gmail.com', 'Another test', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'Summer-2020 result.pdf', 'How to Write a Better Thesis-Textbook.pdf', 'Final-Assignment-ART203-Sec-L-Sl-13.pdf', 'application/pdf', 'application/pdf', 'application/pdf', 0, NULL, NULL, NULL, 4, 4, 2019, 'admin2@gmail.com                             ', 'admin2@gmail.com                             ', 'BCSE                             ', 'rtrtrt                             ', 'a                             ', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(74, 'I2021073', 'mdnasim6416@gmail.com', 'Plant wealth of Lal-Bagh, Bangalore, Horticulture department', 4, 'jkjk', 'Practicum Student List Spring 2021.pdf', '000000.pdf', 'Practicum Student List Spring 2021.pdf', 'application/pdf', 'application/pdf', 'application/pdf', 0, NULL, NULL, NULL, 2, 3, 2020, 'mdnasim6416@gmail.com Nasim Nasim Nasim                          ', 'mdnasim6416@gmail.com mdnasim6416@gmail.com mdnasim6416@gmail.com 17203056@iubat.edu                          ', '2323 rere 2323 343                          ', '2323 IUBAT DHAKA erer                          ', 'Khulna Khulna Khulna Khulna                          ', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(75, 'I2021075', 'mdnasim6416@gmail.com', 'Plant wealth of Lal-Bagh, Bangalore, Horticulture departmental', 1, 'sdsfdff', 'Md.Nasim Hossain.pdf', '000000.pdf', 'Practicum Student List Spring 2021.pdf', 'application/pdf', 'application/pdf', 'application/pdf', 0, NULL, NULL, NULL, 1, 2, 2021, 'mdnasimiubat@gmail.com                             ', 'mdnasimiubat@gmail.com                             ', '2323                             ', 'a                             ', 'Khulna                             ', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reviewertable`
--

CREATE TABLE `reviewertable` (
  `id` int(11) NOT NULL,
  `paperid` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `primaryemail` varchar(100) DEFAULT NULL,
  `assigndate` int(100) DEFAULT NULL,
  `assignmonth` int(100) DEFAULT NULL,
  `assignyear` int(100) DEFAULT NULL,
  `endingdate` int(100) DEFAULT NULL,
  `endingmonth` int(100) DEFAULT NULL,
  `endingyear` int(100) DEFAULT NULL,
  `feedback` varchar(8000) DEFAULT NULL,
  `feedbackdate` int(100) DEFAULT NULL,
  `feedbackmonth` int(100) DEFAULT NULL,
  `feedbackyear` int(100) DEFAULT NULL,
  `action` int(11) DEFAULT NULL,
  `accepted` int(11) DEFAULT NULL,
  `permits` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviewertable`
--

INSERT INTO `reviewertable` (`id`, `paperid`, `username`, `primaryemail`, `assigndate`, `assignmonth`, `assignyear`, `endingdate`, `endingmonth`, `endingyear`, `feedback`, `feedbackdate`, `feedbackmonth`, `feedbackyear`, `action`, `accepted`, `permits`) VALUES
(19, 'I2021017', 'halim', 'mdnasimiubat@gmail.com', 12, 1, 2021, NULL, NULL, NULL, 'Abstract Should be Precise.', 18, 1, 2021, NULL, 1, 1),
(20, 'I2021063', 'nasim92', 'mdnasim6416@gmail.com', 14, 1, 2021, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL),
(21, 'I2021020', 'nasim92', 'mdnasim6416@gmail.com', 14, 1, 2021, NULL, NULL, NULL, 'Good Paper', 16, 1, 2021, NULL, 1, NULL),
(22, 'I2021020', 'engr32', 'ali@gmail.com', 14, 1, 2021, NULL, NULL, NULL, 'Good Carry ON', 17, 1, 2021, NULL, 1, NULL),
(23, 'I2021020', 'engr32', 'ali@gmail.com', 16, 1, 2021, NULL, NULL, NULL, 'Good', 16, 1, 2021, NULL, 1, NULL),
(33, 'I2021072', 'Author40', '17203056@iubat.edu', 30, 1, 2021, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL),
(42, 'I2021072', 'halim', 'mdnasimiubat@gmail.com', 31, 1, 2021, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(44, 'I2021075', 'nasim92', 'mdnasim6416@gmail.com', 1, 2, 2021, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(45, 'I2021017', 'Author2', 'author2@gmail.com', 1, 2, 2021, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(46, 'I2021063', 'halim', 'mdnasimiubat@gmail.com', 1, 2, 2021, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `paperid` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `review` varchar(200) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `paperid`, `email`, `review`, `time`) VALUES
(4, '16', 'admin@gmail.com', '12', '2020-12-12 07:14:16'),
(5, '16', 'admin@gmail.com', 'Abstract Should be Improved !', '2020-12-12 07:14:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `primaryemail` (`primaryemail`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `editortable`
--
ALTER TABLE `editortable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paper`
--
ALTER TABLE `paper`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `paperid` (`paperid`);

--
-- Indexes for table `reviewertable`
--
ALTER TABLE `reviewertable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `editortable`
--
ALTER TABLE `editortable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `paper`
--
ALTER TABLE `paper`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `reviewertable`
--
ALTER TABLE `reviewertable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
