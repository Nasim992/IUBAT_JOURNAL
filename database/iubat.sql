-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 06, 2021 at 09:45 PM
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
(2, 'admin', 'admin ALi Ahmed', '5fb6e2a60c9da41e0a94fe6157ddb93f', 'admin@gmail.com', '099343');

-- --------------------------------------------------------

--
-- Table structure for table `archive`
--

CREATE TABLE `archive` (
  `id` int(11) NOT NULL,
  `versionissue` varchar(255) NOT NULL,
  `paperid` varchar(255) DEFAULT NULL,
  `papername` varchar(255) DEFAULT NULL,
  `authorname` varchar(255) DEFAULT NULL,
  `abstract` varchar(8000) DEFAULT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `publisheddate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `archive`
--

INSERT INTO `archive` (`id`, `versionissue`, `paperid`, `papername`, `authorname`, `abstract`, `filename`, `publisheddate`) VALUES
(1, '2017', 'Archive1', 'Analysis of Land Air\r\nTemperature Variability and\r\nClimate Change', 'Md. Monirul Islam', ' Monthly time series (1971 to 2007) of Land Air Temperature (LAT) data were analyzed\r\nfor Bangladesh. Monthly mean LAT anomalies and synoptic anomalies were determined for analyzing\r\nthe LAT variability. The effect of El Nino and La Nina were also observed by using synoptic anomalies of\r\nLAT anomalies. Positive trend of LAT was established from the 37 years (1971-2007) LAT data by using\r\nsynoptic anomalies. Statistical model was used to find out the best probability distribution function (PDF)\r\nfor the selected study area. The warmer or cooler trends of LAT were discussed and the Log-normal curve\r\nwas selected as the best-fitted PDF curve for Bangladesh. From the trends analysis it was deduced that\r\nthe weather of Bangladesh getting warmer.', 'V1N2_A1_Full.pdf', '2017-01-02'),
(2, '2017', 'Archive2', 'Quality in Higher Education:\r\nAn Empirical Investigation', 'Selina Nargis and Khandakar Iftekharul Islam', ' Higher education has a pervasive impact on the entire education system. However,\r\nto meet society’s expectations of higher education, the question of quality becomes crucial. It cannot be\r\noverlooked.\r\nQuality depends on teaching methods and the institutional commitment to create an environment\r\nfor learning. In addition to teachers, students need physical, social, cultural, and psychological security.\r\nSometimes forgotten is that higher education students are adults. Teaching adults requires adult treatment.\r\nThis paper is a case study of a leading non-government university in Bangladesh. It assesses the university’s various aspects of quality assessment via a survey of opinion among faculty, students and alumni.', 'V1N2_A2_Full.pdf', '2017-01-01'),
(3, '2017', 'Archive3', 'Monetary Policy and Equity\r\nReturn: Evidence from the US\r\nMarkets', 'Mozaffar Alam Chowdhury', ' This paper investigates the relationship between interest rate changes and equity returns\r\nduring crisis periods following the “dot com” bubble burst (1999-2001) and the Lehman Brothers collapse\r\n(2008). Several relevant macroeconomic variables have been considered for forecasting – using a time\r\nseries model, a vector autoregressive model and impulse response functions, including variance decomposition of fluctuations in equity prices. The data are from the Federal Reserve data sets, 1999 to 2016.The\r\nresults indicate a significant change in the nature of the stock market response to monetary policy action\r\nin August 2007. The monetary policy makers failed to boost the stock market during the crisis periods.', 'V1N2_A3_Full.pdf', '2017-01-01'),
(4, '2017', 'Archive4', 'Improvement of Livelihood\r\nthrough Diversified Income\r\nGeneration', 'Abdul Jabber, Selina Nargis and Muhammad Shahjahan', ' This paper evaluates existing modern rice technology adoption and the possibility of\r\nincreasing household income of resource-poor farms under three diversified production environments in\r\nBangladesh. The potential expansion of modern rice technology has nearly been exhausted in areas displaying favorable production environments. In these areas, there remains scope for enhancing household\r\nincome through non-rice crop production. On the other hand, the prospect for increased productivity seems\r\nelusive in the tidal wetland areas unless flood-resistant rice varieties can be developed and adopted. The\r\noutput in flood-prone areas devoted to Modern Variety (MV) rice cultivation in the Transplanted Aman (T.\r\nAman) season is 35%, against the national average of 60%. To cultivate a larger area under a flood-prone\r\nenvironment, alternative crops such as vegetables may be cultivated immediately after the recession of\r\nflood water. About 38% of the cropped land in drought-prone areas is devoted to MV T. Aman season rice\r\ncultivation. Low diffusion of modern technology, caused by infrastructural backwardness, is a prominent\r\nbarrier to higher agricultural income generation for farms in drought-prone areas of Bangladesh.', 'V1N2_A4_Full.pdf', '2017-01-01'),
(5, '2017', 'Archive5', 'Mobilizing Education for Sustainable\r\nDevelopment Program in the Regional\r\nCentre of Expertise Greater Dhaka:', 'Muhammad Rehan Dastagir, Mohammed Ataur Rahman, Muhammad Azizul Hoque.', ': This paper describes the holistic approach of an academic institution in pursuing the environmental dimension of the Sustainable Development Goals (SDGs). International University of Business\r\nAgriculture and Technology (IUBAT) is host of the Regional Centre of Expertise (RCE) Greater Dhaka.\r\nIt has been taking various steps, based on the Global Actions Program (GAP), to support sustainable\r\neducation. The sustainability practices include energy saving, waste water reuse, waste management, tree\r\nplantation, reduction of carbon footprint, greening the campus, etc. IUBAT, as the RCE Greater Dhaka,\r\nis a pioneer institution playing a crucial role in disseminating sustainable education to students, youth\r\nand the wider community. This requires a combined effort of the IUBAT faculty, students, administration\r\nand operations staff. The RCE Greater Dhaka has a nationwide impact because first, it is providing a\r\nmodel educational institution for sustainable activities in Bangladesh and second, it is training resource\r\npersons (such as students trained in sustainable knowledge) who will take a leading role in Bangladesh’s\r\nfuture. This study discusses some positive achievements.', 'V1N2_A5_Full.pdf', '2017-01-01'),
(6, '2017', 'Archive6', 'Arsenic risk analysis of\r\nBangladesh using geographical\r\ninformation system', 'Md. Monirul Islam and Rifat Sumona Mollik', ' Arsenic contamination of ground water is a widely prevalent phenomenon in Bangladesh. It is a\r\nform of groundwater pollution due to naturally occurring high concentrations of arsenic in deeper\r\nlevels of groundwater. Arsenic contamination of groundwater in Bangladesh was discovered by the\r\nSchool of Environmental Studies (SOES) in 1992 (Dhar et al., 1997). The natural contamination\r\nof tube wells has led to widespread human exposure to arsenic through drinking water (Dhar et\r\nal., 1997). Since consumption of cereals and vegetables is a significant route of human exposure\r\nto arsenic, use of groundwater for irrigation of crops raises the question of arsenic uptake in food.\r\nThe impact of arsenic-contaminated irrigation on rice is especially important as rice is the major\r\nstaple food, and it may be grown in soil where irrigation has introduced arsenic from groundwater.\r\nArsenic contamination in irrigation would be a toxic to rice leading to reduced yields (Paul, B.K.\r\net. al. 2000). Shallow aquifers (20–70 m) generally have the highest levels of arsenic. The present\r\nstudy dealt with the map of irrigation land coverage, population, arsenic contamination of ground\r\nwater and then converted the map into the Geographical Information System (GIS) data and maps,\r\nand then utilized the arsenic effect on irrigated land coverage and arsenic impact on population.\r\nSix categories of arsenic contamination maps were used to assess the levels of arsenic in different\r\nareas of Bangladesh. A risk map for administrative districts of Bangladesh was developed using\r\nboth irrigation and population maps, interacting with groundwater arsenic concentration map\r\n(developed by Jakaria 2000)', 'V1N2_A6_Full.pdf', '2017-01-01'),
(7, '2017', 'Archive7', 'Techniques of Rapid\r\nPrototyping and Comparision\r\nwith Computer Numerically\r\nControlled Machining', 'Arijit Sen.', ': Rapid prototyping is a developing technology in product design and manufacturing.\r\nThis paper describes the various techniques of rapid prototyping and compares the cost and surface quality of prototypes produced in fused deposition modelling and 3D printing with that of CNC (Computer\r\nNumerically Controlled) machining. It was found that the fused deposition modelling method produces\r\nthe prototype with the best surface quality and CNC machines produce the prototype at least cost.', 'V1N2_A7_Full.pdf', '2017-01-01'),
(8, '2017', 'Archive8', 'Development of multi hazards map for Bangladesh using GIS technique', 'Monirul Islam Mahfuzur Rahman Xiaoying Li,Nahidul Islam', ' ', 'V1N2_A8_Full.pdf', '2017-01-01'),
(9, '2017', 'Archive9', 'Tributes to the founder of\r\nIUBAT', 'Professor Dr. Abdur Rab', ' The day was like any other in 1988. A group of\r\n10-12 people entered the brick-wall, tin-roof\r\nrestaurant. Minutes later, came the sound of\r\nbreaking chairs, tables and glasses, as well as a\r\nhue & cry. People dashed out of the restaurant\r\nand ran away. There was an ‘all quiet’ in the\r\nrestaurant. About an hour later, leaders of a\r\nmob chanted very loud slogans calling on their\r\nfollowers to attack the restaurant, which was\r\nstormed with pebbles and bricks from three\r\nsides – a three-pronged attack by hundreds of\r\npeople. Several rounds of gun shots came from\r\ninside the restaurant. Despite this, the mob\r\nmarched on and got closer to the restaurant.\r\nSuddenly, people came out of the restaurant\r\nand tried to run away. But in vain. One by one\r\nthey were chased, caught and beaten. Then the\r\nattackers helped the injured onto rickshaws\r\nand paid the rickshaw pullers – perhaps to take\r\nthem to a hospital. The attackers entered the\r\nrestaurant as victors and soon it was humming\r\nwith loud voices and laughter.', 'V1N2_A9_Full.pdf', '2017-01-01'),
(10, '2016', 'V1A1', 'A Study on New Green Methods\r\nof Generating Electricity', 'Razin Ahmed, Rezoana Arif, and Bishwajit Saha.', ': In this paper, a new method of electricity generation, namely geothermal technique based on\r\ncarbon dioxide (CO2), is proposed as a partial solution to the power generation needs of Bangladesh. This\r\ngeothermal technique is an environmentally friendly and safe method of electricity generation compared\r\nto some other methods of power generation. Although the cost of the overall system is high, especially for\r\nstorage of liquid CO2 this high cost can be reduced by using multiple sub-systems of power generation.\r\nEvery brick field can set up a CO2 trap including a liquefied conversion unit. The pros and cons of the\r\nnewly proposed method have been discussed extensively with some specific points related to environmental\r\nand technical issues. The overall results show that the new method can be useful in Bangladesh to generate\r\nan adequate supply of electricity to meet demand', 'V1N1_A1_Full.pdf', '2016-01-01'),
(11, '2016', 'V1N2', 'Under-Five Mortality', 'John Richards and Aidan R. Vining', ': This article analyzes institutional factors associated with under-five mortality at two intervals (2000-03 and 2010-13) among low-income countries, with an emphasis on South Asia. The factors\r\nconsidered fall in four broad categories: health sector inputs (national per capita ratios of professional\r\nhealth care providers and hospital beds, plus public health spending as percent of GDP), performance\r\nof public health institutions (access to safe water and sanitary toilet facilities, child immunization, total\r\nfertility rate, and access to mosquito nets in malaria-prone countries), social determinants of health\r\n(female literacy, percent under $1.25/day and per capita GDP), and effectiveness of national governments in providing services. In explaining changes in mortality levels between decades, four factors are\r\nsignificant: increase in percent above $1.25/day, in vaccination rates and in rates of use of mosquito nets,\r\nplus average government effectiveness over the decade. In explaining mortality levels, the top quarter\r\nof countries ranked by under-five mortality outperform on average the comparable averages for the\r\nthree other quarters on nine factors assessed. Achieving top-quarter mortality levels requires superior\r\nperformance among most of the complex institutional factors such as schools and sanitary infrastructure.', 'V1N1_A2_Full.pdf', '2016-10-01'),
(12, '2016', 'V1N3', 'Facebook Marketing Creating Opportunities for Women Entrepreneurs in Bangladesh', 'Abu Naser Ahmed Ishtiaque and Sumaiya Minnat.', 'Facebook marketing is the most popular method for online marketing today. You will\r\nhardly find any business now without a Facebook presence. The main advantage of Facebook marketing is its vast audience. According to Facebook, there are currently over one billion daily active users\r\non average. The number of businesses using Facebook is growing rapidly around the world, even in our\r\ncountry. From large conglomerates to small businesses, most are on Facebook. Both large and small\r\ncompanies are promoting their products on Facebook. In Bangladesh, like most of the world, Facebook\r\nmarketing has created opportunities for women entrepreneurs who can now sell different products from\r\ntheir home. Many fashion boutiques have flourished over the last few years solely depending on Facebook for their marketing efforts. Even though the number of Facebook “likes” seems to be related to the\r\npopularity of the brand, research shows that the key performance indicator is the Facebook Engagement\r\nFactor (F.E.F), i.e., the number of people interacting with the page. This research paper contains survey\r\nresults and in-depth analysis of 50 fashion boutiques in Bangladesh that use Facebook for marketing\r\ntheir products, the majority of which are run by women. They use paid advertisement, word of mouth,\r\nand frequent posts as tools to promote their page. The Facebook Engagement Factor, not the number of\r\nlikes, is the determinant of how well the page is doing. Small business owners who market their products\r\nthrough Facebook pages thus have to concentrate more on increasing F.E.F than the number of likes of\r\ntheir page in order to be successful.', 'V1N1_A3_Full.pdf', '2016-01-01'),
(13, '2016', 'V1N4', 'Assessment of the Integrated Urban Water\r\nManagement Strategic Plan of Accra City', 'M.A. Hashnat Badsha', ' Accra, the capital city of Ghana, is facing on major challenges in both water supply and\r\nsanitation. Urban sprawl has outpaced planning of infrastructure and public services by more than a\r\ndecade due to rapid urbanization and a high population growth rate. As a result, providing water and\r\nsanitation services to all in a fast growing, largely unplanned city like Accra is a great challenge. In order\r\nto meet these challenges, the Integrated Urban Water Management (IUWM) is introduced and IUWM\r\nprovides an outline for planning, designing, and managing urban water systems. Although, Accra and\r\nDhaka city are geographically located in two different regions on the earth, but there are some similarities,\r\nwhich have been found between them. Similarly, many differences have also been observed. In addition,\r\nthe IUWM strategic plans of Accra city have been assessed by the two different engineering tools in order to generate different scenarios before and after considering the strategic directions suggested by the\r\nSWITCH—Sustainable Water Improves Tomorrow’s Cities’ Health project. In this regard, Aquacycle13,\r\na modern urban water balancing model has been used in this study where the developed scenarios have\r\nshowed the future prediction on the basis of the different strategies that must be executed in future. Finally,\r\nthis study makes an outline of IUWM strategic directions for the Dhaka city in Bangladesh, based on its\r\nfuture challenges and lesson learnt from the existing strategic plan of Accra, Ghana.', 'V1N1_A4_Full.pdf', '2016-01-01'),
(14, '2016', 'V1N5', 'Research and Scientific Data\r\nManagement in Academic\r\nInstitutions', 'Mozaffar Alam Chowdhury', ' : The study of this paper is about research and scientific data management in academic\r\ninstitutions. Academic institutions are the creators of scientific research data, generated from both primary\r\nand secondary research. The objectives of the study are to identify research in academic institutions and\r\nidentify how scientific raw data are managed, identify the data ownership in the research project, identify\r\nquality of raw data in research and identify the dissemination and publication process of the research results\r\nby academic institutions. The methodology of this study is based on secondary research that examines\r\nthe theoretical framework of research in scientific disciplines. Data management addresses the key issues\r\nfrom raw data collection to recording in a hard and soft copy. Reputable academic institutions implement\r\nguidelines and policies for scientific data dissemination and publication. Finally, the suggestions with the\r\nconcluding remarks have been made. ', 'V1N2_A5_Full.pdf', '2016-01-01'),
(15, '2016', 'V1N6', 'Design and Performance Analysis of Coaxial\r\nProbe-fed Rectangular Microstrip Patch\r\nAntenna (RMPA) for IEEE 802.11p Standard', 'Mohammad Tareq and Razin Ahmed', 'In this paper a rectangular microstrip patch antenna (RMPA) has been designed with\r\ncoaxial feeding for 5.9GHz resonant frequency. This frequency spectrum is known as Wave Access in\r\nVehicular Environment (WAVE) or IEEE 802.11p. Performance of the RMPA has been analysed by the\r\nsimulation tool CST Microwave Studio v.2012. Several performance parameters such as return loss,\r\nbandwidth, Voltage Standing Wave Ratio (VSWR), directivity, gain and radiation efficiency have been\r\nobtained by simulation. This antenna has shown desirable results after a few optimization of design\r\nspecifications. Designed RMPA resonates at 5.93 GHz and bandwidth has been found as 0.1417 GHz\r\nwhich has fractional bandwidth of 2.39% and that covers IEEE 802.11p band. Directivity and gain\r\nobtained at resonant frequency are 5.52 dBi and -0.174 dB respectively. The proposed RMPA radiation\r\nefficiency was found as 26.93% and VSWR as 1.05. As an overall evaluation, this antenna’s performance\r\nwas found to beat a satisfactory level.', 'V1N2_A6_Full.pdf', '2016-01-01'),
(16, '2018', 'C1N1', 'Review Paper on:\r\nUASB Bioreactor for Sewage\r\nTreatment', 'Samiha Binte Shohid, Rowshan Mamtaz and M.Shohidullah Miah', ' : The Up-flow Anaerobic Sludge Blanket (UASB) is a low cost and high rate of treatment\r\nprocess that can produce more bio-energy benefits in terms of biogas production. The UASB treatment\r\nprocess cannot completely remove the organic matter and pathogenic microorganisms. Therefore, a\r\npost-treatment process is required for UASB effluent before discharge to the environment to be reused\r\nand recycled for agricultural irrigation. The post-treatment of UASB effluent may be an aerobic process,\r\nsuch as a Final Polishing Ponds Unit system (FPU); Trickling Filters (TF); Rotating Biological Contactor\r\n(RBC); Bio-Filter (BF); Sand Filter; Sequence Batch Reactor (SBR) and Down-flow Hanging Sponge\r\nSystem (DHS). Alternatively, the post-treatment of UASB effluent may be an anaerobic process such as\r\nAnaerobic Bio-film Fluidized Bed reactor; Anaerobic Sludge Thickening and Digestion Process; Anaerobic\r\nHybrid Reactor (AHR); Anaerobic Filter Process (AF) and Dissolved Air Flotation system which are not\r\nperformed well for the treatment of sewage. Among the systems for treating UASB effluent, Down-flow\r\nHanging Sponge System (DHS) is the best combination process. It reduces significantly the organic load\r\nand pathogenic microorganisms. It produces less excess sludge and a final effluent with higher level of\r\ndissolved oxygen.', 'CurrentIssue_A1_Full.pdf', '2018-01-01'),
(17, '2018', 'C1N2', 'Depiction and Analysis of a\r\nSplit P-shaped Microstrip Patch\r\nAntenna for S, C, X, and\r\nKu-band Applications', 'Md. Jubaer Alam', ' In this paper, a split P-shaped multiband microstrip patch antenna is designed and its\r\nmeasurement results in terms of different parameters are given. This patch antenna is designed to support models with resonances at 3.48 GHz, 5.85 GHz, 9.4 GHz, 12.91 GHz, 15.93 GHz and 19.06 GHz.\r\nFR-4 (lossy) is used as a substrate to design the recommended antenna which has a firm dimension of\r\n18×20 mm2. This antenna operates at S, C, X, and Ku band with moderate bandwidth because of its\r\ndesign and feedline. This mixed quadrilateral shaped multiband antenna has directivity gain of 2.61dBi,\r\n5.78dBi, 3.04dBi, 0.97dBi, 3.42dBi and 7.47dBi at resonating frequencies and is suitable for a modern\r\ncommunication system. The proposed split multiband antenna results are obtained in terms of Return\r\nLoss, Voltage Standing Wave ratio, Gain and Radiation Pattern which have admissible values of return\r\nloss less than -10 dB, Efficiency more than 80% at each resonant frequency and Gain more than 5 dB.\r\nA suitable radiation pattern and an emerging gain make the recommended antenna suitable for the use\r\nin a modern communication system.', 'CurrentIssue_A2_Full.pdf', '2016-01-01'),
(18, '2018', 'V1N3', 'Vulnerability Analysis for Sustainable Development\r\nagainst Flood Hazard and Relief Distribution:\r\nA Case Study of 2017 Flood of Bangladesh', 'Monirul Islam, Mahfuzur Rahman, Xiaoying Li and Nahidul Islam', ': Floods are one of the most destructive natural hazards. Bangladesh and its neighbors\r\nin India and Myanmar are highly vulnerable to flood hazards. This study addressed a methodology\r\nto assess the relationship between flood hazard vulnerability and relief distribution based on the flood\r\nhazard event of 2017 of Bangladesh, using Geographical Information System (GIS). Flood vulnerability\r\nmaps were developed through a vulnerability score, calculated on the basis of the interactive effect of\r\nobserved vulnerabilities. Then, flood vulnerability ranks were determined using the ranking matrix of\r\nthree-dimensional multiplication modes by the interactive effect of three vulnerability maps: flood-affected\r\npeople, flood-affected infrastructure, and flood-affected crop land. The resulting map revealed the degree of vulnerability of districts to flood hazard events. The analyses exhibit that 49.9% of districts (31\r\ndistricts out of 64) were to some extent vulnerable to a flood hazard event. Moreover, the GIS technique\r\nwas used to identify the correlation of flood vulnerability (for people, infrastructure, and crop land) and\r\nrelief distribution in terms of rice, cash, and dry food. The correlation was determined by overlaying relief\r\ndistribution data on developed vulnerability maps. The correlation matrix between flood-affected crops\r\nland map and relief distribution (cash in BDT) showed the highest congruence (78.85%). Finally, flood\r\nvulnerability maps for administrative districts provide relevant information about mitigation techniques\r\nand countermeasures against flood damages.', 'CurrentIssue_A3_Full.pdf', '2018-01-01'),
(19, '2018', 'V1N4', 'Are We Faithful to the\r\nConcept plus Practice of\r\nInterdisciplinarity?', 'Iván G. Somlai.', 'The preponderance of projects and conflict situations that, at times, reach unexpected\r\ncomplexity may be mitigated by engaging in collaborative and collective conceptualisation, planning and\r\nimplementation of improvements. One of the most effective ways to ensure proper design and execution\r\nof needed work is that a collective of various specialists, likely to be involved at some stage of a project’s\r\nlifetime, think and work through ideas presented by one another. History shows that useful insights often\r\narise from orthogonal specialists collaborating in civil society, government and industry. Academe has a\r\npotent role in research and development of solutions for complexities in all domains, and should set the\r\nexample for seeking interdisciplinary solutions.', 'CurrentIssue_A4_Full.pdf', '2018-01-01'),
(20, '2018', 'V1N5', 'The Accord and Alliance:\r\nLessons learned after five years\r\nof remediation', 'Selina Nargis and Khandakar Iftekharul Islam', ' : In response to the tragic Rana Plaza building collapse in 2013, major western clothing\r\nbrands launched two initiatives: Bangladesh Accord on Fire and Building Safety (Accord) and Alliance\r\nfor Bangladesh Worker Safety {Alliance). The initiatives sought to remediate the many violations of\r\nglobal electrical, fire, and structural standards among Bangladeshi ready-made garment (RMG) factories\r\nsupplying these major brands. The agreements between the two initiatives and the government of\r\nBangladesh ended in June, 2018. While meaningful progress was made in the remediation of electrical\r\nand fire deficiencies, inspection data from the Accord (up to late 2016) showed at that time that about\r\nhalf of identified structural problems remained unsolved, with a large portion of structural repairs\r\nover two years past their deadlines. The pace of remediation for these repairs was much slower than\r\nexpected. As the Alliance has ended its intensive remediation work and the Accord seeks to begin a threeyear extension, this article provides an update and suggests several lessons to be applied in the future.\r\nKEYWORDS: corporate social responsibility; labour rights; Bangladesh; apparel; governance;\r\noccupational safety.', 'CurrentIssue_A5_Full.pdf', '2018-01-01'),
(21, '2018', 'V1N6', 'Sustainable SupplyChain\r\nManagement Practices and\r\nChallenges of Agri-business in\r\nBangladesh', 'Zahir Rayhan Salim', 'Supply Chain Management (SCM) concerns management of the total flow of a distribution\r\nchannel from supplier to end consumer. It is a set of activities that promotes an effective management of\r\nsupplier partnerships, meeting customer demands, movement of goods and information sharing throughout\r\nthe supply network of an industry. The fundamental difference between food supply chains and other\r\nchains is the continuous and significant changes in the quality of agro-food products throughout the supply chain network. SCM activities (like service, delivery, and information)pose major difficulties in the\r\nagro-food sector. Furthermore, competitiveness in supply chains has been a key issue for organizations\r\nand mapping the competitiveness of an organization helps to form a sound basis for sustainable business development. Agro-food industries have to deal with government rules, customer and stakeholders’\r\ninterests, seasonality, supply spikes, long supply lead time and perishability. Strategically, rather than\r\ncompeting within low-cost market segments, many agro-food producers are following a differentiation\r\nstrategy that targets niche market segments like organic foods. Studies have identified that stakeholders\r\nsuch as consumers, retailers, suppliers and regulators are the influential force driving firms to balance\r\nenvironmental aspects of their business with financial performance. The agri-business and sustainable\r\nchallenges are observed using graphical representation through survey.', 'CurrentIssue_A6_Full.pdf', '2018-01-01');

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
  `validation_code` varchar(255) NOT NULL,
  `activation` int(11) DEFAULT NULL,
  `associateeditor` int(100) DEFAULT NULL,
  `academiceditor` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`id`, `username`, `title`, `firstname`, `middlename`, `lastname`, `primaryemail`, `primaryemailcc`, `secondaryemail`, `secondaryemailcc`, `password`, `contact`, `address`, `registrationtime`, `reviewerselection`, `validation_code`, `activation`, `associateeditor`, `academiceditor`) VALUES
(5, 'nasim92', 'Dr Hamer.', 'Md.', 'John', 'Doe', 'mdnasim6416@gmail.com', 'nasimAli@gmail.com', 'sdfsf@gmail.com', 'mdnasim6416@gmail.com', '5fb6e2a60c9da41e0a94fe6157ddb93f', '+880175570641623', 'Dhaka', '2020-12-25 04:28:24', 1, '0', 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `chiefeditor`
--

CREATE TABLE `chiefeditor` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chiefeditor`
--

INSERT INTO `chiefeditor` (`id`, `fullname`, `password`, `email`, `contact`) VALUES
(1, 'John Doe ', '5fb6e2a60c9da41e0a94fe6157ddb93f', 'chief@gmail.com', '9999999');

-- --------------------------------------------------------

--
-- Table structure for table `editortable`
--

CREATE TABLE `editortable` (
  `id` int(11) NOT NULL,
  `paperid` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `primaryemail` varchar(100) DEFAULT NULL,
  `assigndate` varchar(255) DEFAULT NULL,
  `endingdate` varchar(255) DEFAULT NULL,
  `feedback` varchar(8000) DEFAULT NULL,
  `feedbackdate` varchar(100) DEFAULT NULL,
  `action` int(11) DEFAULT NULL,
  `accepted` int(11) DEFAULT NULL,
  `associateeditor` int(100) DEFAULT NULL,
  `academiceditor` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `pdate` varchar(255) DEFAULT NULL,
  `uploaddate` varchar(255) DEFAULT NULL,
  `coauthorname` varchar(1000) NOT NULL,
  `coauthoremail` varchar(1000) NOT NULL,
  `coauthordept` varchar(1000) NOT NULL,
  `coauthorinstitute` varchar(1000) NOT NULL,
  `coauthoraddress` varchar(1000) NOT NULL,
  `resubmitpaper` varchar(255) DEFAULT NULL,
  `resubmitdate` varchar(100) DEFAULT NULL,
  `reject` int(100) DEFAULT NULL,
  `rejectdate` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `reviewertable`
--

CREATE TABLE `reviewertable` (
  `id` int(11) NOT NULL,
  `paperid` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `primaryemail` varchar(100) DEFAULT NULL,
  `assigndate` varchar(100) DEFAULT NULL,
  `endingdate` varchar(100) DEFAULT NULL,
  `feedback` varchar(8000) DEFAULT NULL,
  `feedbackfile` varchar(255) DEFAULT NULL,
  `feedbackdate` varchar(100) DEFAULT NULL,
  `action` int(11) DEFAULT NULL,
  `accepted` int(11) DEFAULT NULL,
  `permits` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Indexes for table `archive`
--
ALTER TABLE `archive`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `primaryemail` (`primaryemail`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `chiefeditor`
--
ALTER TABLE `chiefeditor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `archive`
--
ALTER TABLE `archive`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `chiefeditor`
--
ALTER TABLE `chiefeditor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `editortable`
--
ALTER TABLE `editortable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `paper`
--
ALTER TABLE `paper`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `reviewertable`
--
ALTER TABLE `reviewertable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
