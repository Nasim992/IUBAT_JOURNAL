-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2020 at 01:47 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

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
  `user_name` varchar(100) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `user_name`, `full_name`, `password`, `email`, `contact`) VALUES
(1, 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@gmail.com', '01881212');

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`id`, `name`, `email`, `password`, `contact`, `address`) VALUES
(1, 'Nasim Hossain', 'mdnasim6416@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '01845832673', 'Dhaka'),
(2, 'Md.Author2', 'author2@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '01787232112', 'Khulna'),
(3, 'Md.Author3', 'author3@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '01787232112223', 'Chittagong');

-- --------------------------------------------------------

--
-- Table structure for table `paper`
--

CREATE TABLE `paper` (
  `id` int(11) NOT NULL,
  `authoremail` varchar(100) NOT NULL,
  `papername` varchar(255) NOT NULL,
  `abstract` varchar(8000) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `action` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `paper`
--

INSERT INTO `paper` (`id`, `authoremail`, `papername`, `abstract`, `name`, `type`, `action`) VALUES
(15, 'mdnasim6416@gmail.com', 'Plant wealth of Lal-Bagh, Bangalore, Horticulture department1', 'Nature is the international weekly journal of science: a magazine style journal that publishes full-length research papers in all disciplines of science, as well as News and Views, reviews, news, features, commentaries, web focuses and more, covering all branches of science and how science impacts upon all aspects of society and life.', 'Banglarefruits.pdf', 'application/pdf', 1),
(16, 'mdnasim6416@gmail.com', 'Student to career', 'I recommend Susan of Student to Career to help your child if they are struggling to find their place in the world and what their next steps should be. The testing is complete and detailed. It gives a very accurate picture of the child’s strengths and how they can be enhanced and applied in practical and exciting ways. However, even better than the report is the value that Susan provides. I found her to be dedicated and invested in my son’s progress.  The results we found, we could not have come up with by ourselves. I am grateful that we went through this process.', 'Student Career Research Paper.pdf', 'application/pdf', 0),
(17, 'mdnasim6416@gmail.com', 'Closed environments facilitate secondary transmission of coronavirus disease 2019 (COVID-19)', 'Commissioned by the Minister of the Ministry of Health, Labour, and Welfare of Japan, we collected secondary transmission data with the aim of identifying high risk transmission settings. We show that closed environments contribute to secondary transmission of COVID-19 and promote superspreading events. Closed environments are consistent with large-scale COVID-19 transmission events such as that of the ski chalet-associated cluster in France and the church- and hospital-associated clusters in South Korea. Our findings are also consistent with the declining incidence of COVID-19 cases in China, as gathering in closed environments was prohibited in the wake of the rapid spread of the disease. Reduction of unnecessary close contact in closed environments may help prevent large case clusters and superspreading events.', 'covid-19.pdf', 'application/pdf', 0),
(18, 'mdnasim6416@gmail.com', 'Presumed Asymptomatic Carrier Transmission of COVID-19', 'In January 2020, we enrolled a familial cluster of 5 patients with fever and respiratory symptoms who were admitted to the Fifth People’s Hospital of Anyang, Anyang, China, and 1 asymptomatic family member. This study was approved by the local institutional review board, and written informed consent was obtained from all patients. A detailed analysis of patient records was performed.\r\n\r\nAll patients underwent chest CT imaging. Real-time reverse transcriptase polymerase chain reaction (RT-PCR) tests for COVID-19 nucleic acid were performed using nasopharyngeal swabs (Novel Coronavirus PCR Fluorescence Diagnostic Kit, BioGerm Medical Biotechnology).', 'jama_bai_2020_ld_200013.pdf', 'application/pdf', 0),
(19, 'mdnasim6416@gmail.com', 'Dysregulation of Immune Response in Patients With Coronavirus 2019 (COVID-19) in Wuhan, China', 'Of the 452 patients with COVID-19 recruited, 286 were diagnosed as having severe infection. The median age was\r\n58 years and 235 were male. The most common symptoms were fever, shortness of breath, expectoration, fatigue, dry cough, and myalgia. Severe cases tend to have lower lymphocyte counts, higher leukocyte counts and neutrophil-lymphocyte ratio (NLR), as well\r\nas lower percentages of monocytes, eosinophils, and basophils. Most severe cases demonstrated elevated levels of infection-related\r\nbiomarkers and inflammatory cytokines. The number of T cells significantly decreased, and were more impaired in severe cases.\r\nBoth helper T (Th) cells and suppressor T cells in patients with COVID-19 were below normal levels, with lower levels of Th cells in\r\nthe severe group. The percentage of naive Th cells increased and memory Th cells decreased in severe cases. Patients with COVID-19\r\nalso have lower levels of regulatory T cells, which are more obviously decreased in severe cases.', 'ciaa248.pdf', 'application/pdf', 0),
(20, 'author2@gmail.com', 'TGF-β in progression of liver disease', 'Transforming growth factor-β (TGF-β) is a central regulator in chronic liver disease contributing to all stages of disease progression from initial liver injury through inflammation and fibrosis to cirrhosis and hepatocellular carcinoma. Liver-damage-induced levels of active TGF-β enhance hepatocyte destruction and mediate hepatic stellate cell and fibroblast activation resulting in a wound-healing response, including myofibroblast generation and extracellular matrix deposition. Being recognised as a major profibrogenic cytokine, the targeting of the TGF-β signalling pathway has been explored with respect to the inhibition of liver disease progression. Whereas interference with TGF-β signalling in various short-term animal models has provided promising results, liver disease progression in humans is a process of decades with different phases in which TGF-β or its targeting might have both beneficial and adverse outcomes. Based on recent literature, we summarise the cell-type-directed double-edged role of TGF-β in various liver disease stages. We emphasise that, in order to achieve therapeutic effects, we need to target TGF-β signalling in the right cell type at the right time.', 'Dooley-Dijke2012_Article_TGF-βInProgressionOfLiverDisea.pdf', 'application/pdf', 0),
(21, 'author2@gmail.com', 'Fibrosis and Disease Progression in Hepatitis C ', 'The progression of fibrosis in chronic hepatitis C determines the ultimate prognosis and thus\r\nthe need and urgency of therapy. Fibrogenesis is a complex dynamic process, which is\r\nmediated by necroinflammation and activation of stellate cells. The liver biopsy remains the\r\ngold standard to assess fibrosis. Scoring systems allow a semiquantitative assessment and are\r\nuseful for cross-sectional and cohort studies and in treatment trials. The rate at which fibrosis\r\nprogresses varies markedly between patients. The major factors known to be associated with\r\nfibrosis progression are older age at infection, male gender, and excessive alcohol consumption. Viral load and genotype do not seem to influence significantly the progression rate.\r\nProgression of fibrosis is more rapid in immunocompromised patients. Hepatic steatosis,\r\nobesity, and diabetes may also contribute to more rapid progression of fibrosis. There are no\r\ntests that reliably predict the rate of progression of fibrosis in an individual patient. High\r\nserum alanine aminotransferase (ALT) levels are associated with a higher risk of fibrosis\r\nprogression, and worsening of fibrosis is uncommon in patients with persistently normal\r\nserum aminotransferase levels. Serum markers for fibrosis are not reliable and need to be\r\nimproved and validated. Liver biopsy provides the most accurate information on the stage of\r\nfibrosis and grade of necroinflammation, both of which have prognostic significance. Repeating the liver biopsy, 3 to 5 years after an initial biopsy is the most accurate means of\r\nassessing the progression of fibrosis. (HEPATOLOGY 2002;36:S47-S56.) ', 'hep.1840360707.pdf', 'application/pdf', 1),
(22, 'author3@gmail.com', 'Dropout: A Simple Way to Prevent Neural Networks from Overfitting', 'Deep neural nets with a large number of parameters are very powerful machine learning\r\nsystems. However, overfitting is a serious problem in such networks. Large networks are also\r\nslow to use, making it difficult to deal with overfitting by combining the predictions of many\r\ndifferent large neural nets at test time. Dropout is a technique for addressing this problem.\r\nThe key idea is to randomly drop units (along with their connections) from the neural\r\nnetwork during training. This prevents units from co-adapting too much. During training,\r\ndropout samples from an exponential number of different “thinned” networks. At test time,\r\nit is easy to approximate the effect of averaging the predictions of all these thinned networks\r\nby simply using a single unthinned network that has smaller weights. This significantly\r\nreduces overfitting and gives major improvements over other regularization methods. We\r\nshow that dropout improves the performance of neural networks on supervised learning\r\ntasks in vision, speech recognition, document classification and computational biology,\r\nobtaining state-of-the-art results on many benchmark data sets.', 'srivastava14a.pdf', 'application/pdf', 0),
(23, 'mdnasim6416@gmail.com', 'Reporting results of cancer treatment', 'On the initiative of the World Health Organization, two meetings on the Standardization of Reporting Results of Cancer Treatment have been held with representatives and members of several organizations. Recommendations have been developed for standardized approaches to the recording of baseline data relating to the patient, the tumor, laboratory and radiologic data, the reporting of treatment, grading of acute and subacute toxicity, reporting of response, recurrence and disease‐free interval, and reporting results of therapy. These recommendations, already endorsed by a number of organizations, are proposed for international acceptance and use to make it possible for investigators to compare validly their results with those of others.', '1097-0142(19810101)47_1_207__AID-CNCR2820470134_3.0.CO;2-6.pdf', 'application/pdf', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `paper`
--
ALTER TABLE `paper`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `paper`
--
ALTER TABLE `paper`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
