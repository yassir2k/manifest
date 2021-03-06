USE [manifestDB]
GO
/****** Object:  User [manifestapp]    Script Date: 06/09/2021 12:15:42 ******/
CREATE USER [manifestapp] FOR LOGIN [manifestapp] WITH DEFAULT_SCHEMA=[dbo]
GO
ALTER ROLE [db_owner] ADD MEMBER [manifestapp]
GO
/****** Object:  Table [dbo].[tbl_Batches_History]    Script Date: 06/09/2021 12:15:42 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tbl_Batches_History](
	[Index_ID] [bigint] IDENTITY(1,1) NOT NULL,
	[Batch_Number] [bigint] NULL,
	[Batch_Code] [varchar](50) NOT NULL,
	[Department_Unit] [varchar](40) NOT NULL,
	[Pre_or_Post] [varchar](40) NULL,
	[Date_Generated] [datetime] NULL,
	[Total_Records] [int] NULL,
	[Created_By] [varchar](40) NULL,
	[State_Code] [varchar](3) NOT NULL,
 CONSTRAINT [PK_tbl_Batches_History] PRIMARY KEY CLUSTERED 
(
	[Index_ID] ASC,
	[Batch_Code] ASC,
	[Department_Unit] ASC,
	[State_Code] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tbl_Business_Names]    Script Date: 06/09/2021 12:15:42 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tbl_Business_Names](
	[Index_ID] [bigint] IDENTITY(1,1) NOT NULL,
	[BN_Number] [varchar](40) NULL,
	[Business_Name] [varchar](200) NULL,
	[Company_Type] [varchar](40) NULL,
	[BN_Batch] [varchar](50) NULL,
	[BN_Cert_Gen_Date] [datetime] NULL,
	[BN_Cert_Despatch_Date] [datetime] NULL,
	[BN_Cert_Manifest_Prepared_By] [varchar](200) NULL,
	[BN_Despatch_Status] [varchar](40) NULL,
	[MR_Received_By] [varchar](200) NULL,
	[MR_Receiving_Date] [datetime] NULL,
	[State_Code] [varchar](3) NOT NULL,
 CONSTRAINT [PK_tbl_Business_names] PRIMARY KEY CLUSTERED 
(
	[Index_ID] ASC,
	[State_Code] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tbl_Business_Names_Post]    Script Date: 06/09/2021 12:15:42 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tbl_Business_Names_Post](
	[Index] [bigint] IDENTITY(1,1) NOT NULL,
	[Business_Name] [text] NULL,
	[BN_Number] [varchar](20) NULL,
	[Customer_Phone] [varchar](20) NULL,
	[Ack_By] [varchar](40) NULL,
	[Ack_Date] [datetime] NULL,
	[Originating_Dept_Unit] [varchar](100) NULL,
	[Originating_Dept_Ref] [varchar](100) NULL,
	[Courier] [varchar](40) NULL,
	[Prepared_By] [varchar](40) NULL,
	[Preparation_Date] [datetime] NULL,
	[Forward_to] [varchar](40) NULL,
	[Forwarding_Date] [datetime] NULL,
	[State_Code] [varchar](3) NOT NULL,
 CONSTRAINT [PK_tbl_Business_Names_Post] PRIMARY KEY CLUSTERED 
(
	[Index] ASC,
	[State_Code] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tbl_Compliance_Post]    Script Date: 06/09/2021 12:15:42 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tbl_Compliance_Post](
	[Index] [bigint] IDENTITY(1,1) NOT NULL,
	[Company_Name] [text] NULL,
	[RC_Number] [varchar](20) NULL,
	[Reference_No] [varchar](100) NULL,
	[Type_of_Application] [varchar](100) NULL,
	[Customer_Phone] [varchar](20) NULL,
	[Customer_Address] [text] NULL,
	[Ack_By] [varchar](40) NULL,
	[Ack_Date] [datetime] NULL,
	[Originating_Dept_Unit] [varchar](100) NULL,
	[Originating_Dept_Ref] [varchar](100) NULL,
	[Courier] [varchar](40) NULL,
	[Prepared_By] [varchar](40) NULL,
	[Preparation_Date] [datetime] NULL,
	[Forward_to] [varchar](40) NULL,
	[Forwarding_Date] [datetime] NULL,
	[State_Code] [varchar](3) NOT NULL,
 CONSTRAINT [PK_tbl_Compliance_Post] PRIMARY KEY CLUSTERED 
(
	[Index] ASC,
	[State_Code] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tbl_Courier_Companies]    Script Date: 06/09/2021 12:15:42 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tbl_Courier_Companies](
	[Serial_No] [bigint] IDENTITY(1,1) NOT NULL,
	[Initials] [varchar](40) NOT NULL,
	[Courier_Company_Name] [varchar](100) NULL,
	[Contact_Person] [varchar](100) NULL,
	[Phone_No] [varchar](15) NULL,
	[Courier_Address] [text] NULL,
	[Is_Active] [bit] NULL,
	[Task_Flag] [bit] NULL,
	[Total_Rounds_of_Despatch] [bigint] NULL,
	[State_Code] [varchar](3) NOT NULL,
	[Login_Password] [varchar](40) NULL,
 CONSTRAINT [PK_tbl_Courier_Companies] PRIMARY KEY CLUSTERED 
(
	[Serial_No] ASC,
	[Initials] ASC,
	[State_Code] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tbl_Customer_Service_Post]    Script Date: 06/09/2021 12:15:42 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tbl_Customer_Service_Post](
	[Index] [bigint] IDENTITY(1,1) NOT NULL,
	[Company_Name] [text] NULL,
	[RC_Number] [varchar](20) NULL,
	[Nature_of_Application] [text] NULL,
	[Customer_Phone_Number] [varchar](20) NULL,
	[Acknowledged_By] [varchar](40) NULL,
	[Ack_Date] [datetime] NULL,
	[CSP_Despatch_Date] [datetime] NULL,
	[CSP_Despatched_By] [varchar](40) NULL,
	[MR_Ack_By] [varchar](40) NULL,
	[MR_Ack_Date] [datetime] NULL,
	[State_Code] [varchar](3) NOT NULL,
 CONSTRAINT [PK_tbl_Customer_Service_Post] PRIMARY KEY CLUSTERED 
(
	[Index] ASC,
	[State_Code] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tbl_Despatch_Tracking]    Script Date: 06/09/2021 12:15:42 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tbl_Despatch_Tracking](
	[Index] [bigint] IDENTITY(1,1) NOT NULL,
	[Serial_No] [varchar](40) NULL,
	[RC_Number] [varchar](40) NULL,
	[Company_Name] [varchar](250) NULL,
	[Company_Type] [varchar](40) NULL,
	[Courier_Ack_Date] [datetime] NULL,
	[Initials] [varchar](40) NOT NULL,
	[MR_Despatched_By] [varchar](100) NULL,
	[MR_Despatched_Timestamp] [datetime] NULL,
	[Collected_By_Customer] [bit] NULL,
	[Collection_Date] [datetime] NULL,
	[Collectors_Name_Phone] [varchar](200) NULL,
	[Dept_Unit_Batch_Code] [varchar](100) NULL,
	[MR_Batch_Code] [varchar](100) NULL,
	[State_Code] [varchar](3) NOT NULL,
 CONSTRAINT [PK_tbl_Despatch_Tracking] PRIMARY KEY CLUSTERED 
(
	[Index] ASC,
	[Initials] ASC,
	[State_Code] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tbl_Finance]    Script Date: 06/09/2021 12:15:42 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tbl_Finance](
	[ID] [bigint] IDENTITY(1,1) NOT NULL,
	[Company_Name] [varchar](200) NULL,
	[RC_Number] [varchar](10) NULL,
	[Company_Type] [varchar](40) NULL,
	[Nature_of_Application] [varchar](200) NULL,
	[Payment_Reference] [varchar](16) NULL,
	[Amount] [money] NULL,
	[Ack_From_MR_by] [varchar](40) NULL,
	[Ack_Date] [varchar](40) NULL,
	[Emailing_Dept] [varchar](40) NULL,
	[Emailing_Dept_Ack_Date] [varchar](40) NULL,
	[Sender] [varchar](40) NULL,
	[Verified] [bit] NULL,
	[Verified_By] [varchar](40) NULL,
	[Verification_Date] [datetime] NULL,
	[Destinating_Department] [varchar](40) NULL,
	[Email_or_Courier] [varchar](40) NULL,
	[Courier_Outgoing] [varchar](40) NULL,
	[State_Code] [varchar](3) NOT NULL,
 CONSTRAINT [PK_tbl_Finance] PRIMARY KEY CLUSTERED 
(
	[ID] ASC,
	[State_Code] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tbl_Log]    Script Date: 06/09/2021 12:15:42 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tbl_Log](
	[Index] [bigint] IDENTITY(1,1) NOT NULL,
	[Event] [text] NULL,
	[Event_Timestamp] [datetime] NULL,
	[User_] [varchar](40) NULL,
	[IP_Address] [varchar](40) NULL,
	[OS] [varchar](40) NULL,
	[Device] [varchar](40) NULL,
	[Browser] [varchar](100) NULL,
	[Ref_Code] [varchar](200) NULL,
	[State_Code] [varchar](3) NOT NULL,
 CONSTRAINT [PK_tbl_Log] PRIMARY KEY CLUSTERED 
(
	[Index] ASC,
	[State_Code] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tbl_Mail_Room]    Script Date: 06/09/2021 12:15:42 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tbl_Mail_Room](
	[MR_Index] [bigint] IDENTITY(1,1) NOT NULL,
	[Serial_No] [varchar](40) NOT NULL,
	[RC_Number] [varchar](40) NULL,
	[Company_Name] [varchar](200) NULL,
	[Company_Type] [varchar](40) NULL,
	[REG_Batch] [varchar](50) NULL,
	[IT_Batch] [varchar](50) NULL,
	[BN_Batch] [varchar](50) NULL,
	[Received_From_REG_on] [datetime] NULL,
	[Received_From_IT_on] [datetime] NULL,
	[Received_From_BN_on] [datetime] NULL,
	[Courier_Forwarded_to] [varchar](100) NULL,
	[Courier_Forwarding_Date] [datetime] NULL,
	[Forwarded_By] [varchar](100) NULL,
	[MR_Batch_Code] [varchar](50) NULL,
	[State_Code] [varchar](3) NOT NULL,
 CONSTRAINT [PK_tbl_Mail_Room] PRIMARY KEY CLUSTERED 
(
	[MR_Index] ASC,
	[Serial_No] ASC,
	[State_Code] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tbl_MR_Post_Receive]    Script Date: 06/09/2021 12:15:42 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tbl_MR_Post_Receive](
	[Index] [bigint] IDENTITY(1,1) NOT NULL,
	[Originating_Batch_Code] [varchar](100) NOT NULL,
	[Company Name] [text] NULL,
	[RC_Number] [varchar](15) NULL,
	[Company_Type] [varchar](40) NULL,
	[Originating_Dept_Unit] [varchar](50) NULL,
	[Nature_of_Application] [varchar](200) NULL,
	[Customer_Phone] [varchar](20) NULL,
	[Prepared_By] [varchar](40) NULL,
	[Preparation_Date] [datetime] NULL,
	[Ack_By] [varchar](40) NULL,
	[Ack_Date] [datetime] NULL,
	[State_Code] [varchar](3) NOT NULL,
 CONSTRAINT [PK_tbl_MR_Post_Receive] PRIMARY KEY CLUSTERED 
(
	[Index] ASC,
	[Originating_Batch_Code] ASC,
	[State_Code] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tbl_MR_Post_Send]    Script Date: 06/09/2021 12:15:42 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tbl_MR_Post_Send](
	[Index] [bigint] IDENTITY(1,1) NOT NULL,
	[MR_Batch_Ref] [varchar](100) NOT NULL,
	[Company Name] [text] NULL,
	[RC_Number] [varchar](15) NULL,
	[Company_Type] [varchar](40) NULL,
	[Nature_of_Application] [varchar](200) NULL,
	[Customer_Phone] [varchar](20) NULL,
	[Accepting_Dept] [varchar](50) NULL,
	[Prepared_By] [varchar](40) NULL,
	[Preparation_Date] [datetime] NULL,
	[Ack_By] [varchar](40) NULL,
	[Ack_Date] [datetime] NULL,
	[Courier] [varchar](40) NULL,
	[State_Code] [varchar](3) NOT NULL,
 CONSTRAINT [PK_tbl_MR_Post_Send] PRIMARY KEY CLUSTERED 
(
	[Index] ASC,
	[MR_Batch_Ref] ASC,
	[State_Code] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tbl_Nature_of_Application]    Script Date: 06/09/2021 12:15:42 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tbl_Nature_of_Application](
	[ID] [bigint] IDENTITY(1,1) NOT NULL,
	[RC_Number] [varchar](12) NULL,
	[Company_Name] [varchar](200) NULL,
	[Company_Type] [varchar](40) NULL,
	[Payment_Reference] [varchar](16) NULL,
	[Nature] [varchar](100) NULL,
	[Nature_Reference] [varchar](16) NULL,
	[Transaction_ID] [varchar](20) NULL,
	[State_Code] [varchar](3) NOT NULL,
 CONSTRAINT [PK_tbl_Nature_of_Application] PRIMARY KEY CLUSTERED 
(
	[ID] ASC,
	[State_Code] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tbl_Receive_Post_Applications]    Script Date: 06/09/2021 12:15:42 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tbl_Receive_Post_Applications](
	[Index] [bigint] IDENTITY(1,1) NOT NULL,
	[MR_Batch_Ref] [varchar](100) NOT NULL,
	[Company_Name] [varchar](300) NULL,
	[RC_Number] [varchar](15) NULL,
	[Company_Type] [varchar](40) NULL,
	[Nature_Reference] [varchar](16) NULL,
	[Presenter_Name] [varchar](100) NULL,
	[Presenter_Phone] [varchar](20) NULL,
	[Presenter_Email] [varchar](200) NULL,
	[Courier_Incoming] [varchar](40) NULL,
	[Date_Received] [datetime] NULL,
	[Destinating_Dept] [varchar](50) NULL,
	[Forwarding_Date] [datetime] NULL,
	[Forwarded_By] [varchar](40) NULL,
	[Courier_Outgoing] [varchar](40) NULL,
	[Payment_Reference] [varchar](16) NULL,
	[No_of_Copies] [int] NULL,
	[Details] [text] NULL,
	[Confirmed_By_FinAcc] [bit] NULL,
	[Audited] [bit] NULL,
	[Task_Status] [bigint] NULL,
	[Transaction_ID] [varchar](20) NULL,
	[State_Code] [varchar](3) NOT NULL,
 CONSTRAINT [PK_tbl_Receive_Post_Applications] PRIMARY KEY CLUSTERED 
(
	[Index] ASC,
	[MR_Batch_Ref] ASC,
	[State_Code] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tbl_Registry]    Script Date: 06/09/2021 12:15:42 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tbl_Registry](
	[Index_ID] [bigint] IDENTITY(1,1) NOT NULL,
	[Serial_No] [varchar](20) NOT NULL,
	[RC_Number] [varchar](20) NULL,
	[Company_Name] [varchar](250) NULL,
	[Company_Type] [varchar](40) NULL,
	[REG_Batch] [varchar](50) NULL,
	[Received_From_RGO_On] [datetime] NULL,
	[RGO_Batch] [varchar](50) NULL,
	[REG_Manifest_Prepared_By] [varchar](200) NULL,
	[REG_Manifest_Preparation_Date] [datetime] NULL,
	[REG_Despatch_Status] [varchar](40) NULL,
	[MR_Received_By] [varchar](200) NULL,
	[MR_Receiving_Date] [datetime] NULL,
	[State_Code] [varchar](3) NOT NULL,
 CONSTRAINT [PK_tbl_Registry] PRIMARY KEY CLUSTERED 
(
	[Index_ID] ASC,
	[Serial_No] ASC,
	[State_Code] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tbl_Registry_Post]    Script Date: 06/09/2021 12:15:42 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tbl_Registry_Post](
	[Index] [bigint] IDENTITY(1,1) NOT NULL,
	[Company_Name] [text] NULL,
	[RC_Number] [varchar](20) NULL,
	[Nature_of_Application] [varchar](100) NULL,
	[Customer_Phone] [varchar](20) NULL,
	[Ack_By] [varchar](40) NULL,
	[Ack_Date] [datetime] NULL,
	[Originating_Dept_Unit] [varchar](100) NULL,
	[Originating_Dept_Ref] [varchar](100) NULL,
	[Courier] [varchar](40) NULL,
	[Prepared_By] [varchar](40) NULL,
	[Preparation_Date] [datetime] NULL,
	[Forward_to] [varchar](40) NULL,
	[Forwarding_Date] [datetime] NULL,
	[KIV_or_Not] [varchar](40) NULL,
	[State_Code] [varchar](3) NOT NULL,
 CONSTRAINT [PK_tbl_Registry_Post] PRIMARY KEY CLUSTERED 
(
	[Index] ASC,
	[State_Code] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tbl_RGs_office]    Script Date: 06/09/2021 12:15:42 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tbl_RGs_office](
	[Index_ID] [bigint] IDENTITY(1,1) NOT NULL,
	[Serial_No] [varchar](20) NOT NULL,
	[RC_Number] [varchar](20) NULL,
	[Company_Name] [varchar](250) NULL,
	[Company_Type] [varchar](40) NULL,
	[Pre_or_Post] [varchar](40) NULL,
	[RGO_Batch] [varchar](50) NULL,
	[RGO_Cert_Gen_Date] [datetime] NULL,
	[RGO_Cert_Despatch_Date] [datetime] NULL,
	[RGO_Cert_Despatched_By] [varchar](200) NULL,
	[RGO_Despatch_Status] [varchar](40) NULL,
	[REG_Received_By] [varchar](200) NULL,
	[REG_Receiving_Date] [datetime] NULL,
	[IT_Received_By] [varchar](200) NULL,
	[IT_Receiving_Date] [datetime] NULL,
	[State_Code] [varchar](3) NOT NULL,
 CONSTRAINT [PK_tbl_RGs_office] PRIMARY KEY CLUSTERED 
(
	[Index_ID] ASC,
	[Serial_No] ASC,
	[State_Code] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tbl_RRR_History]    Script Date: 06/09/2021 12:15:42 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tbl_RRR_History](
	[ID] [bigint] IDENTITY(1,1) NOT NULL,
	[RRR_Number] [varchar](20) NULL,
	[Amount] [money] NULL,
	[RC_Number] [varchar](20) NULL,
	[Date_Captured] [datetime] NULL,
	[Payment_Reference] [varchar](16) NULL,
	[Transaction_ID] [varchar](20) NULL,
	[State_Code] [varchar](3) NOT NULL,
 CONSTRAINT [PK_tbl_RRR_History] PRIMARY KEY CLUSTERED 
(
	[ID] ASC,
	[State_Code] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tbl_Schedule_officers]    Script Date: 06/09/2021 12:15:42 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tbl_Schedule_officers](
	[Index_ID] [bigint] IDENTITY(1,1) NOT NULL,
	[First_Name] [varchar](40) NULL,
	[Surname] [varchar](40) NULL,
	[Department] [varchar](40) NULL,
	[Role] [varchar](40) NULL,
	[Login_ID] [varchar](40) NOT NULL,
	[Login_Password] [varchar](40) NULL,
	[Is_Active] [varchar](40) NULL,
	[State_Code] [varchar](3) NOT NULL,
	[Email] [varchar](250) NULL,
	[Password_Recovery_Code] [text] NULL,
	[New_Account_Refcode] [text] NULL,
	[Date_Requested] [datetime] NULL,
	[Date_Approved] [datetime] NULL,
	[Email_Verified] [bit] NULL,
 CONSTRAINT [PK_tbl_Schedule_officers] PRIMARY KEY CLUSTERED 
(
	[Index_ID] ASC,
	[Login_ID] ASC,
	[State_Code] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tbl_States]    Script Date: 06/09/2021 12:15:42 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tbl_States](
	[State_Code] [varchar](3) NOT NULL,
	[State_Name] [varchar](15) NOT NULL,
 CONSTRAINT [PK_tbl_States] PRIMARY KEY CLUSTERED 
(
	[State_Code] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tbl_Trustees]    Script Date: 06/09/2021 12:15:42 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tbl_Trustees](
	[Index_ID] [bigint] IDENTITY(1,1) NOT NULL,
	[Serial_No] [varchar](20) NOT NULL,
	[RC_Number] [varchar](20) NULL,
	[Company_Name] [varchar](250) NULL,
	[Company_Type] [varchar](40) NULL,
	[IT_Batch] [varchar](50) NULL,
	[Received_From_RGO_On] [datetime] NULL,
	[RGO_Batch] [varchar](50) NULL,
	[IT_Manifest_Prepared_By] [varchar](200) NULL,
	[IT_Manifest_Preparation_Date] [datetime] NULL,
	[IT_Despatch_Status] [varchar](40) NULL,
	[MR_Received_By] [varchar](200) NULL,
	[MR_Receiving_Date] [datetime] NULL,
	[State_Code] [varchar](3) NOT NULL,
 CONSTRAINT [PK_tbl_Trustees] PRIMARY KEY CLUSTERED 
(
	[Index_ID] ASC,
	[Serial_No] ASC,
	[State_Code] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tbl_Trustees_Post]    Script Date: 06/09/2021 12:15:42 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tbl_Trustees_Post](
	[Index] [bigint] IDENTITY(1,1) NOT NULL,
	[IT_Name] [text] NULL,
	[IT_Number] [varchar](20) NULL,
	[Nature_of_Application] [varchar](100) NULL,
	[Customer_Phone] [varchar](20) NULL,
	[Ack_By] [varchar](40) NULL,
	[Ack_Date] [datetime] NULL,
	[Originating_Dept_Unit] [varchar](100) NULL,
	[Originating_Dept_Ref] [varchar](100) NULL,
	[Courier] [varchar](40) NULL,
	[Prepared_By] [varchar](40) NULL,
	[Preparation_Date] [datetime] NULL,
	[Forward_to] [varchar](40) NULL,
	[Forwarding_Date] [datetime] NULL,
	[State_Code] [varchar](3) NOT NULL,
 CONSTRAINT [PK_tbl_Trustees_Post] PRIMARY KEY CLUSTERED 
(
	[Index] ASC,
	[State_Code] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
SET IDENTITY_INSERT [dbo].[tbl_Batches_History] ON 

INSERT [dbo].[tbl_Batches_History] ([Index_ID], [Batch_Number], [Batch_Code], [Department_Unit], [Pre_or_Post], [Date_Generated], [Total_Records], [Created_By], [State_Code]) VALUES (20089, 1, N'FCT-RGO-03032021111600-PRE-B-1', N'RGs Office', N'Pre', CAST(N'2021-03-03T11:22:29.390' AS DateTime), 3, N'yyahaya', N'FCT')
INSERT [dbo].[tbl_Batches_History] ([Index_ID], [Batch_Number], [Batch_Code], [Department_Unit], [Pre_or_Post], [Date_Generated], [Total_Records], [Created_By], [State_Code]) VALUES (20090, 1, N'FCT-REG-03032021112602-PRE-B-1', N'Registry', N'Pre', CAST(N'2021-03-03T11:27:17.513' AS DateTime), 3, N'zyahaya', N'FCT')
INSERT [dbo].[tbl_Batches_History] ([Index_ID], [Batch_Number], [Batch_Code], [Department_Unit], [Pre_or_Post], [Date_Generated], [Total_Records], [Created_By], [State_Code]) VALUES (20091, 1, N'FCT-MR-03032021103618-PRE-B-1', N'Mail Room', N'Pre', CAST(N'2021-03-03T11:39:40.793' AS DateTime), 3, N'kyahaya', N'FCT')
INSERT [dbo].[tbl_Batches_History] ([Index_ID], [Batch_Number], [Batch_Code], [Department_Unit], [Pre_or_Post], [Date_Generated], [Total_Records], [Created_By], [State_Code]) VALUES (20092, 1, N'FCT-RGO-08032021110436-PRE-B-1', N'RGs Office', N'Pre', CAST(N'2021-03-08T11:06:45.983' AS DateTime), 1, N'yyahaya', N'FCT')
INSERT [dbo].[tbl_Batches_History] ([Index_ID], [Batch_Number], [Batch_Code], [Department_Unit], [Pre_or_Post], [Date_Generated], [Total_Records], [Created_By], [State_Code]) VALUES (20093, 1, N'FCT-REG-08032021110814-PRE-B-1', N'Registry', N'Pre', CAST(N'2021-03-08T11:08:21.040' AS DateTime), 1, N'zyahaya', N'FCT')
INSERT [dbo].[tbl_Batches_History] ([Index_ID], [Batch_Number], [Batch_Code], [Department_Unit], [Pre_or_Post], [Date_Generated], [Total_Records], [Created_By], [State_Code]) VALUES (20094, 1, N'FCT-MR-08032021101002-PRE-B-1', N'Mail Room', N'Pre', CAST(N'2021-03-08T11:10:20.963' AS DateTime), 1, N'kyahaya', N'FCT')
INSERT [dbo].[tbl_Batches_History] ([Index_ID], [Batch_Number], [Batch_Code], [Department_Unit], [Pre_or_Post], [Date_Generated], [Total_Records], [Created_By], [State_Code]) VALUES (20095, 1, N'FCT-RGO-10082021085213-PRE-B-1', N'RGs Office', N'Pre', CAST(N'2021-08-10T08:53:29.007' AS DateTime), 2, N'yyahaya', N'FCT')
INSERT [dbo].[tbl_Batches_History] ([Index_ID], [Batch_Number], [Batch_Code], [Department_Unit], [Pre_or_Post], [Date_Generated], [Total_Records], [Created_By], [State_Code]) VALUES (20096, 1, N'FCT-REG-10082021085621-PRE-B-1', N'Registry', N'Pre', CAST(N'2021-08-10T08:56:27.747' AS DateTime), 2, N'zyahaya', N'FCT')
INSERT [dbo].[tbl_Batches_History] ([Index_ID], [Batch_Number], [Batch_Code], [Department_Unit], [Pre_or_Post], [Date_Generated], [Total_Records], [Created_By], [State_Code]) VALUES (20097, 1, N'FCT-MR-10082021095755-PRE-B-1', N'Mail Room', N'Pre', CAST(N'2021-08-10T08:58:27.700' AS DateTime), 2, N'kyahaya', N'FCT')
INSERT [dbo].[tbl_Batches_History] ([Index_ID], [Batch_Number], [Batch_Code], [Department_Unit], [Pre_or_Post], [Date_Generated], [Total_Records], [Created_By], [State_Code]) VALUES (20098, 1, N'FCT-RGO-06092021115541-PRE-B-1', N'RGs Office', N'Pre', CAST(N'2021-09-06T11:56:37.923' AS DateTime), 1, N'yyahaya', N'FCT')
INSERT [dbo].[tbl_Batches_History] ([Index_ID], [Batch_Number], [Batch_Code], [Department_Unit], [Pre_or_Post], [Date_Generated], [Total_Records], [Created_By], [State_Code]) VALUES (20099, 2, N'FCT-RGO-06092021120229-PRE-B-2', N'RGs Office', N'Pre', CAST(N'2021-09-06T12:02:52.120' AS DateTime), 1, N'yyahaya', N'FCT')
INSERT [dbo].[tbl_Batches_History] ([Index_ID], [Batch_Number], [Batch_Code], [Department_Unit], [Pre_or_Post], [Date_Generated], [Total_Records], [Created_By], [State_Code]) VALUES (20100, 3, N'FCT-RGO-06092021120305-PRE-B-3', N'RGs Office', N'Pre', CAST(N'2021-09-06T12:12:42.223' AS DateTime), 1, N'yyahaya', N'FCT')
SET IDENTITY_INSERT [dbo].[tbl_Batches_History] OFF
GO
SET IDENTITY_INSERT [dbo].[tbl_Courier_Companies] ON 

INSERT [dbo].[tbl_Courier_Companies] ([Serial_No], [Initials], [Courier_Company_Name], [Contact_Person], [Phone_No], [Courier_Address], [Is_Active], [Task_Flag], [Total_Rounds_of_Despatch], [State_Code], [Login_Password]) VALUES (1, N'Fedex', N'FEDEX (RED STAR EXPRESS)', N'ROTIMI EMMANUEL', N'09072425179', N'No 1, Bechar Street, Off Mabolo Street, Off Sultan Abubakar Way, Wuse Zone 2, Abuja', 1, 0, 1, N'FCT', N'121212')
INSERT [dbo].[tbl_Courier_Companies] ([Serial_No], [Initials], [Courier_Company_Name], [Contact_Person], [Phone_No], [Courier_Address], [Is_Active], [Task_Flag], [Total_Rounds_of_Despatch], [State_Code], [Login_Password]) VALUES (2, N'GWX', N'GWX GREATER WASHIGTON EXPRESS LOGISTIC', N'SUNDAY IGOMU', N'08112592888', N'Plot 10/19, Gimbiya Street, Area 11, Garki, Abuja', 1, 0, 1, N'FCT', N'121212')
INSERT [dbo].[tbl_Courier_Companies] ([Serial_No], [Initials], [Courier_Company_Name], [Contact_Person], [Phone_No], [Courier_Address], [Is_Active], [Task_Flag], [Total_Rounds_of_Despatch], [State_Code], [Login_Password]) VALUES (3, N'Hyper', N'HYPER MOVE LOG', N'OSENI ADAH', N'09033543333', N'Nicon Plaza, 2nd Floor, CBD, Abuja', 1, 1, 0, N'FCT', N'121212')
INSERT [dbo].[tbl_Courier_Companies] ([Serial_No], [Initials], [Courier_Company_Name], [Contact_Person], [Phone_No], [Courier_Address], [Is_Active], [Task_Flag], [Total_Rounds_of_Despatch], [State_Code], [Login_Password]) VALUES (4, N'Hubgrid', N'HUBGRID LOG', N'PATRICIA OGBECHE', N'07030077805', N'105d, Novare Shared Office, Novare Mall, Zone 5, Abuja', 1, 0, 0, N'FCT', N'121212')
INSERT [dbo].[tbl_Courier_Companies] ([Serial_No], [Initials], [Courier_Company_Name], [Contact_Person], [Phone_No], [Courier_Address], [Is_Active], [Task_Flag], [Total_Rounds_of_Despatch], [State_Code], [Login_Password]) VALUES (5, N'Box1', N'BOX1 LOG', N'PRAYER JATAU', N'07040737253', N'Suite C206, Garki Mall, Opp Garki Int’l Market, Abuja', 1, 0, 0, N'FCT', N'121212')
INSERT [dbo].[tbl_Courier_Companies] ([Serial_No], [Initials], [Courier_Company_Name], [Contact_Person], [Phone_No], [Courier_Address], [Is_Active], [Task_Flag], [Total_Rounds_of_Despatch], [State_Code], [Login_Password]) VALUES (6, N'Sultan', N'SULTAN COURIER SERV.', N'ADENIYI ELISHA', N'08048124444', N'Block 6b, Ajaokuta Street, Area 2, Garki, Abuja', 1, 0, 0, N'FCT', N'121212')
INSERT [dbo].[tbl_Courier_Companies] ([Serial_No], [Initials], [Courier_Company_Name], [Contact_Person], [Phone_No], [Courier_Address], [Is_Active], [Task_Flag], [Total_Rounds_of_Despatch], [State_Code], [Login_Password]) VALUES (7, N'EMS', N'EMS NIPOST', N'EKANEM N. JOEL', N'08100020246', N'1279, Muhammadu Buhari Way, Garki 2, Near Old CBN, Abuja', 1, 0, 1, N'FCT', N'121212')
INSERT [dbo].[tbl_Courier_Companies] ([Serial_No], [Initials], [Courier_Company_Name], [Contact_Person], [Phone_No], [Courier_Address], [Is_Active], [Task_Flag], [Total_Rounds_of_Despatch], [State_Code], [Login_Password]) VALUES (8, N'DHL', N'DHL', N'PRECIOUS OZIGAGU', N'09018494913', N'No 63, Adetokunbo Ademola Crescent, Wuse 2, Abuja', 1, 0, 0, N'FCT', N'121212')
SET IDENTITY_INSERT [dbo].[tbl_Courier_Companies] OFF
GO
SET IDENTITY_INSERT [dbo].[tbl_Despatch_Tracking] ON 

INSERT [dbo].[tbl_Despatch_Tracking] ([Index], [Serial_No], [RC_Number], [Company_Name], [Company_Type], [Courier_Ack_Date], [Initials], [MR_Despatched_By], [MR_Despatched_Timestamp], [Collected_By_Customer], [Collection_Date], [Collectors_Name_Phone], [Dept_Unit_Batch_Code], [MR_Batch_Code], [State_Code]) VALUES (74, N'111111', N'101010', N'ABC', N'LLC', CAST(N'2021-03-03T11:47:19.923' AS DateTime), N'EMS', N'kyahaya', CAST(N'2021-03-03T11:39:40.793' AS DateTime), NULL, NULL, NULL, N'FCT-REG-03032021112602-PRE-B-1', N'FCT-MR-03032021103618-PRE-B-1', N'FCT')
INSERT [dbo].[tbl_Despatch_Tracking] ([Index], [Serial_No], [RC_Number], [Company_Name], [Company_Type], [Courier_Ack_Date], [Initials], [MR_Despatched_By], [MR_Despatched_Timestamp], [Collected_By_Customer], [Collection_Date], [Collectors_Name_Phone], [Dept_Unit_Batch_Code], [MR_Batch_Code], [State_Code]) VALUES (75, N'222222', N'202020', N'KLM', N'LLC', CAST(N'2021-03-03T11:47:19.923' AS DateTime), N'EMS', N'kyahaya', CAST(N'2021-03-03T11:39:40.793' AS DateTime), NULL, NULL, NULL, N'FCT-REG-03032021112602-PRE-B-1', N'FCT-MR-03032021103618-PRE-B-1', N'FCT')
INSERT [dbo].[tbl_Despatch_Tracking] ([Index], [Serial_No], [RC_Number], [Company_Name], [Company_Type], [Courier_Ack_Date], [Initials], [MR_Despatched_By], [MR_Despatched_Timestamp], [Collected_By_Customer], [Collection_Date], [Collectors_Name_Phone], [Dept_Unit_Batch_Code], [MR_Batch_Code], [State_Code]) VALUES (76, N'333333', N'303030', N'XYZ', N'LLC', CAST(N'2021-03-03T11:47:19.923' AS DateTime), N'EMS', N'kyahaya', CAST(N'2021-03-03T11:39:40.793' AS DateTime), NULL, NULL, NULL, N'FCT-REG-03032021112602-PRE-B-1', N'FCT-MR-03032021103618-PRE-B-1', N'FCT')
INSERT [dbo].[tbl_Despatch_Tracking] ([Index], [Serial_No], [RC_Number], [Company_Name], [Company_Type], [Courier_Ack_Date], [Initials], [MR_Despatched_By], [MR_Despatched_Timestamp], [Collected_By_Customer], [Collection_Date], [Collectors_Name_Phone], [Dept_Unit_Batch_Code], [MR_Batch_Code], [State_Code]) VALUES (77, N'121212', N'1163911', N'Kaiglo Stores Limited', N'LLC', CAST(N'2021-03-08T11:12:03.233' AS DateTime), N'Fedex', N'kyahaya', CAST(N'2021-03-08T11:10:20.963' AS DateTime), NULL, NULL, NULL, N'FCT-REG-08032021110814-PRE-B-1', N'FCT-MR-08032021101002-PRE-B-1', N'FCT')
INSERT [dbo].[tbl_Despatch_Tracking] ([Index], [Serial_No], [RC_Number], [Company_Name], [Company_Type], [Courier_Ack_Date], [Initials], [MR_Despatched_By], [MR_Despatched_Timestamp], [Collected_By_Customer], [Collection_Date], [Collectors_Name_Phone], [Dept_Unit_Batch_Code], [MR_Batch_Code], [State_Code]) VALUES (78, N'232211', N'98711', N'AZEX', N'LLC', CAST(N'2021-08-10T09:00:18.650' AS DateTime), N'GWX', N'kyahaya', CAST(N'2021-08-10T08:58:27.700' AS DateTime), NULL, NULL, NULL, N'FCT-REG-10082021085621-PRE-B-1', N'FCT-MR-10082021095755-PRE-B-1', N'FCT')
INSERT [dbo].[tbl_Despatch_Tracking] ([Index], [Serial_No], [RC_Number], [Company_Name], [Company_Type], [Courier_Ack_Date], [Initials], [MR_Despatched_By], [MR_Despatched_Timestamp], [Collected_By_Customer], [Collection_Date], [Collectors_Name_Phone], [Dept_Unit_Batch_Code], [MR_Batch_Code], [State_Code]) VALUES (79, N'990032', N'456790', N'RAVE', N'LLC', CAST(N'2021-08-10T09:00:18.650' AS DateTime), N'GWX', N'kyahaya', CAST(N'2021-08-10T08:58:27.700' AS DateTime), NULL, NULL, NULL, N'FCT-REG-10082021085621-PRE-B-1', N'FCT-MR-10082021095755-PRE-B-1', N'FCT')
SET IDENTITY_INSERT [dbo].[tbl_Despatch_Tracking] OFF
GO
SET IDENTITY_INSERT [dbo].[tbl_Log] ON 

INSERT [dbo].[tbl_Log] ([Index], [Event], [Event_Timestamp], [User_], [IP_Address], [OS], [Device], [Browser], [Ref_Code], [State_Code]) VALUES (20153, N'New Pre Incorporation Manifest RG -> Registry', CAST(N'2021-03-03T11:22:29.720' AS DateTime), N'yyahaya', N'::1', N'Win10', N'Desktop', N'Chrome', N'FCT-RGO-03032021111600-PRE-B-1', N'FCT')
INSERT [dbo].[tbl_Log] ([Index], [Event], [Event_Timestamp], [User_], [IP_Address], [OS], [Device], [Browser], [Ref_Code], [State_Code]) VALUES (20154, N'Acknowledgement of Manifest from RG -> Registry', CAST(N'2021-03-03T11:23:53.903' AS DateTime), N'zyahaya', N'::1', N'Win10', N'Desktop', N'Edge', N'-', N'FCT')
INSERT [dbo].[tbl_Log] ([Index], [Event], [Event_Timestamp], [User_], [IP_Address], [OS], [Device], [Browser], [Ref_Code], [State_Code]) VALUES (20155, N'Forwarding of Manifest from Registry -> Mail Room', CAST(N'2021-03-03T11:27:17.860' AS DateTime), N'zyahaya', N'::1', N'Win10', N'Desktop', N'Edge', N'FCT-REG-03032021112602-PRE-B-1', N'FCT')
INSERT [dbo].[tbl_Log] ([Index], [Event], [Event_Timestamp], [User_], [IP_Address], [OS], [Device], [Browser], [Ref_Code], [State_Code]) VALUES (20156, N'Acknowledgement of Manifest from Registry -> Mail Room', CAST(N'2021-03-03T11:28:20.950' AS DateTime), N'kyahaya', N'::1', N'Win10', N'Desktop', N'Edge', N'-', N'FCT')
INSERT [dbo].[tbl_Log] ([Index], [Event], [Event_Timestamp], [User_], [IP_Address], [OS], [Device], [Browser], [Ref_Code], [State_Code]) VALUES (20157, N'Acknowledgement of Manifest from Registry -> Mail Room', CAST(N'2021-03-03T11:28:33.777' AS DateTime), N'kyahaya', N'::1', N'Win10', N'Desktop', N'Edge', N'-', N'FCT')
INSERT [dbo].[tbl_Log] ([Index], [Event], [Event_Timestamp], [User_], [IP_Address], [OS], [Device], [Browser], [Ref_Code], [State_Code]) VALUES (20158, N'New Manifest Despatch Mail Room -> Courier', CAST(N'2021-03-03T11:39:40.933' AS DateTime), N'kyahaya', N'::1', N'Win10', N'Desktop', N'Edge', N'FCT-MR-03032021103618-PRE-B-1', N'FCT')
INSERT [dbo].[tbl_Log] ([Index], [Event], [Event_Timestamp], [User_], [IP_Address], [OS], [Device], [Browser], [Ref_Code], [State_Code]) VALUES (20159, N'Acknowledgement of Manifest by Courier (EMS) from Mail Room', CAST(N'2021-03-03T11:47:19.983' AS DateTime), N'EMS', N'::1', N'Win10', N'Desktop', N'Edge', N'-', N'FCT')
INSERT [dbo].[tbl_Log] ([Index], [Event], [Event_Timestamp], [User_], [IP_Address], [OS], [Device], [Browser], [Ref_Code], [State_Code]) VALUES (20160, N'New Pre Incorporation Manifest RG -> Registry', CAST(N'2021-03-08T11:06:46.200' AS DateTime), N'yyahaya', N'::1', N'Win10', N'Desktop', N'Chrome', N'FCT-RGO-08032021110436-PRE-B-1', N'FCT')
INSERT [dbo].[tbl_Log] ([Index], [Event], [Event_Timestamp], [User_], [IP_Address], [OS], [Device], [Browser], [Ref_Code], [State_Code]) VALUES (20161, N'Acknowledgement of Manifest from RG -> Registry', CAST(N'2021-03-08T11:07:52.780' AS DateTime), N'zyahaya', N'::1', N'Win10', N'Desktop', N'Chrome', N'-', N'FCT')
INSERT [dbo].[tbl_Log] ([Index], [Event], [Event_Timestamp], [User_], [IP_Address], [OS], [Device], [Browser], [Ref_Code], [State_Code]) VALUES (20162, N'Forwarding of Manifest from Registry -> Mail Room', CAST(N'2021-03-08T11:08:21.083' AS DateTime), N'zyahaya', N'::1', N'Win10', N'Desktop', N'Chrome', N'FCT-REG-08032021110814-PRE-B-1', N'FCT')
INSERT [dbo].[tbl_Log] ([Index], [Event], [Event_Timestamp], [User_], [IP_Address], [OS], [Device], [Browser], [Ref_Code], [State_Code]) VALUES (20163, N'Acknowledgement of Manifest from Registry -> Mail Room', CAST(N'2021-03-08T11:09:36.100' AS DateTime), N'kyahaya', N'::1', N'Win10', N'Desktop', N'Chrome', N'-', N'FCT')
INSERT [dbo].[tbl_Log] ([Index], [Event], [Event_Timestamp], [User_], [IP_Address], [OS], [Device], [Browser], [Ref_Code], [State_Code]) VALUES (20164, N'New Manifest Despatch Mail Room -> Courier', CAST(N'2021-03-08T11:10:21.007' AS DateTime), N'kyahaya', N'::1', N'Win10', N'Desktop', N'Chrome', N'FCT-MR-08032021101002-PRE-B-1', N'FCT')
INSERT [dbo].[tbl_Log] ([Index], [Event], [Event_Timestamp], [User_], [IP_Address], [OS], [Device], [Browser], [Ref_Code], [State_Code]) VALUES (20165, N'Acknowledgement of Manifest by Courier (Fedex) from Mail Room', CAST(N'2021-03-08T11:12:03.277' AS DateTime), N'Fedex', N'::1', N'Win10', N'Desktop', N'Chrome', N'-', N'FCT')
INSERT [dbo].[tbl_Log] ([Index], [Event], [Event_Timestamp], [User_], [IP_Address], [OS], [Device], [Browser], [Ref_Code], [State_Code]) VALUES (20166, N'New Pre Incorporation Manifest RG -> Registry', CAST(N'2021-08-10T08:53:29.017' AS DateTime), N'yyahaya', N'::1', N'unknown', N'', N'Default Browser', N'FCT-RGO-10082021085213-PRE-B-1', N'FCT')
INSERT [dbo].[tbl_Log] ([Index], [Event], [Event_Timestamp], [User_], [IP_Address], [OS], [Device], [Browser], [Ref_Code], [State_Code]) VALUES (20167, N'Acknowledgement of Manifest from RG -> Registry', CAST(N'2021-08-10T08:55:52.723' AS DateTime), N'zyahaya', N'::1', N'unknown', N'', N'Default Browser', N'-', N'FCT')
INSERT [dbo].[tbl_Log] ([Index], [Event], [Event_Timestamp], [User_], [IP_Address], [OS], [Device], [Browser], [Ref_Code], [State_Code]) VALUES (20168, N'Forwarding of Manifest from Registry -> Mail Room', CAST(N'2021-08-10T08:56:27.747' AS DateTime), N'zyahaya', N'::1', N'unknown', N'', N'Default Browser', N'FCT-REG-10082021085621-PRE-B-1', N'FCT')
INSERT [dbo].[tbl_Log] ([Index], [Event], [Event_Timestamp], [User_], [IP_Address], [OS], [Device], [Browser], [Ref_Code], [State_Code]) VALUES (20169, N'Acknowledgement of Manifest from Registry -> Mail Room', CAST(N'2021-08-10T08:57:21.610' AS DateTime), N'kyahaya', N'::1', N'unknown', N'', N'Default Browser', N'-', N'FCT')
INSERT [dbo].[tbl_Log] ([Index], [Event], [Event_Timestamp], [User_], [IP_Address], [OS], [Device], [Browser], [Ref_Code], [State_Code]) VALUES (20170, N'New Manifest Despatch Mail Room -> Courier', CAST(N'2021-08-10T08:58:27.703' AS DateTime), N'kyahaya', N'::1', N'unknown', N'', N'Default Browser', N'FCT-MR-10082021095755-PRE-B-1', N'FCT')
INSERT [dbo].[tbl_Log] ([Index], [Event], [Event_Timestamp], [User_], [IP_Address], [OS], [Device], [Browser], [Ref_Code], [State_Code]) VALUES (20171, N'Acknowledgement of Manifest by Courier (GWX) from Mail Room', CAST(N'2021-08-10T09:00:18.650' AS DateTime), N'GWX', N'::1', N'unknown', N'', N'Default Browser', N'-', N'FCT')
INSERT [dbo].[tbl_Log] ([Index], [Event], [Event_Timestamp], [User_], [IP_Address], [OS], [Device], [Browser], [Ref_Code], [State_Code]) VALUES (20172, N'New Pre Incorporation Manifest RG -> Registry', CAST(N'2021-09-06T11:56:37.943' AS DateTime), N'yyahaya', N'::1', N'unknown', N'', N'Default Browser', N'FCT-RGO-06092021115541-PRE-B-1', N'FCT')
INSERT [dbo].[tbl_Log] ([Index], [Event], [Event_Timestamp], [User_], [IP_Address], [OS], [Device], [Browser], [Ref_Code], [State_Code]) VALUES (20173, N'New Pre Incorporation Manifest RG -> Registry', CAST(N'2021-09-06T12:02:52.123' AS DateTime), N'yyahaya', N'::1', N'unknown', N'', N'Default Browser', N'FCT-RGO-06092021120229-PRE-B-2', N'FCT')
INSERT [dbo].[tbl_Log] ([Index], [Event], [Event_Timestamp], [User_], [IP_Address], [OS], [Device], [Browser], [Ref_Code], [State_Code]) VALUES (20174, N'New Pre Incorporation Manifest RG -> Registry', CAST(N'2021-09-06T12:12:42.247' AS DateTime), N'yyahaya', N'::1', N'Win10', N'Desktop', N'Chrome', N'FCT-RGO-06092021120305-PRE-B-3', N'FCT')
SET IDENTITY_INSERT [dbo].[tbl_Log] OFF
GO
SET IDENTITY_INSERT [dbo].[tbl_Mail_Room] ON 

INSERT [dbo].[tbl_Mail_Room] ([MR_Index], [Serial_No], [RC_Number], [Company_Name], [Company_Type], [REG_Batch], [IT_Batch], [BN_Batch], [Received_From_REG_on], [Received_From_IT_on], [Received_From_BN_on], [Courier_Forwarded_to], [Courier_Forwarding_Date], [Forwarded_By], [MR_Batch_Code], [State_Code]) VALUES (10052, N'111111', N'101010', N'ABC', N'LLC', N'FCT-REG-03032021112602-PRE-B-1', NULL, NULL, CAST(N'2021-03-03T11:28:20.890' AS DateTime), NULL, NULL, N'EMS', CAST(N'2021-03-03T11:39:40.790' AS DateTime), N'kyahaya', N'FCT-MR-03032021103618-PRE-B-1', N'FCT')
INSERT [dbo].[tbl_Mail_Room] ([MR_Index], [Serial_No], [RC_Number], [Company_Name], [Company_Type], [REG_Batch], [IT_Batch], [BN_Batch], [Received_From_REG_on], [Received_From_IT_on], [Received_From_BN_on], [Courier_Forwarded_to], [Courier_Forwarding_Date], [Forwarded_By], [MR_Batch_Code], [State_Code]) VALUES (10053, N'222222', N'202020', N'KLM', N'LLC', N'FCT-REG-03032021112602-PRE-B-1', NULL, NULL, CAST(N'2021-03-03T11:28:33.720' AS DateTime), NULL, NULL, N'EMS', CAST(N'2021-03-03T11:39:40.790' AS DateTime), N'kyahaya', N'FCT-MR-03032021103618-PRE-B-1', N'FCT')
INSERT [dbo].[tbl_Mail_Room] ([MR_Index], [Serial_No], [RC_Number], [Company_Name], [Company_Type], [REG_Batch], [IT_Batch], [BN_Batch], [Received_From_REG_on], [Received_From_IT_on], [Received_From_BN_on], [Courier_Forwarded_to], [Courier_Forwarding_Date], [Forwarded_By], [MR_Batch_Code], [State_Code]) VALUES (10054, N'333333', N'303030', N'XYZ', N'LLC', N'FCT-REG-03032021112602-PRE-B-1', NULL, NULL, CAST(N'2021-03-03T11:28:33.720' AS DateTime), NULL, NULL, N'EMS', CAST(N'2021-03-03T11:39:40.790' AS DateTime), N'kyahaya', N'FCT-MR-03032021103618-PRE-B-1', N'FCT')
INSERT [dbo].[tbl_Mail_Room] ([MR_Index], [Serial_No], [RC_Number], [Company_Name], [Company_Type], [REG_Batch], [IT_Batch], [BN_Batch], [Received_From_REG_on], [Received_From_IT_on], [Received_From_BN_on], [Courier_Forwarded_to], [Courier_Forwarding_Date], [Forwarded_By], [MR_Batch_Code], [State_Code]) VALUES (10055, N'121212', N'1163911', N'Kaiglo Stores Limited', N'LLC', N'FCT-REG-08032021110814-PRE-B-1', NULL, NULL, CAST(N'2021-03-08T11:09:36.050' AS DateTime), NULL, NULL, N'Fedex', CAST(N'2021-03-08T11:10:20.963' AS DateTime), N'kyahaya', N'FCT-MR-08032021101002-PRE-B-1', N'FCT')
INSERT [dbo].[tbl_Mail_Room] ([MR_Index], [Serial_No], [RC_Number], [Company_Name], [Company_Type], [REG_Batch], [IT_Batch], [BN_Batch], [Received_From_REG_on], [Received_From_IT_on], [Received_From_BN_on], [Courier_Forwarded_to], [Courier_Forwarding_Date], [Forwarded_By], [MR_Batch_Code], [State_Code]) VALUES (10056, N'232211', N'98711', N'AZEX', N'LLC', N'FCT-REG-10082021085621-PRE-B-1', NULL, NULL, CAST(N'2021-08-10T08:57:21.607' AS DateTime), NULL, NULL, N'GWX', CAST(N'2021-08-10T08:58:27.700' AS DateTime), N'kyahaya', N'FCT-MR-10082021095755-PRE-B-1', N'FCT')
INSERT [dbo].[tbl_Mail_Room] ([MR_Index], [Serial_No], [RC_Number], [Company_Name], [Company_Type], [REG_Batch], [IT_Batch], [BN_Batch], [Received_From_REG_on], [Received_From_IT_on], [Received_From_BN_on], [Courier_Forwarded_to], [Courier_Forwarding_Date], [Forwarded_By], [MR_Batch_Code], [State_Code]) VALUES (10057, N'990032', N'456790', N'RAVE', N'LLC', N'FCT-REG-10082021085621-PRE-B-1', NULL, NULL, CAST(N'2021-08-10T08:57:21.607' AS DateTime), NULL, NULL, N'GWX', CAST(N'2021-08-10T08:58:27.700' AS DateTime), N'kyahaya', N'FCT-MR-10082021095755-PRE-B-1', N'FCT')
SET IDENTITY_INSERT [dbo].[tbl_Mail_Room] OFF
GO
SET IDENTITY_INSERT [dbo].[tbl_Nature_of_Application] ON 

INSERT [dbo].[tbl_Nature_of_Application] ([ID], [RC_Number], [Company_Name], [Company_Type], [Payment_Reference], [Nature], [Nature_Reference], [Transaction_ID], [State_Code]) VALUES (5, N'12233', N'ABC Limited', N'Limited Liability Company', N'R-4BF3D91B6FCCC7', N'Annual Returns', N'N-3B601A658EF717', N'D18748C462CA8FE3B40C', N'FCT')
INSERT [dbo].[tbl_Nature_of_Application] ([ID], [RC_Number], [Company_Name], [Company_Type], [Payment_Reference], [Nature], [Nature_Reference], [Transaction_ID], [State_Code]) VALUES (6, N'12233', N'ABC Limited', N'Limited Liability Company', N'R-4BF3D91B6FCCC7', N'Increase', N'N-3B601A658EF717', N'D18748C462CA8FE3B40C', N'FCT')
INSERT [dbo].[tbl_Nature_of_Application] ([ID], [RC_Number], [Company_Name], [Company_Type], [Payment_Reference], [Nature], [Nature_Reference], [Transaction_ID], [State_Code]) VALUES (7, N'909090', N'XYZ Ventures', N'Business Names', N'R-E6F7E2C2FF7F72', N'Notice of Change in Business Names', N'N-D8AFF82FBFFCB1', N'A53A3F6E24FDB1EC9872', N'FCT')
INSERT [dbo].[tbl_Nature_of_Application] ([ID], [RC_Number], [Company_Name], [Company_Type], [Payment_Reference], [Nature], [Nature_Reference], [Transaction_ID], [State_Code]) VALUES (8, N'909090', N'XYZ Ventures', N'Business Names', N'R-E6F7E2C2FF7F72', N'Notice of Cessation of Business', N'N-D8AFF82FBFFCB1', N'A53A3F6E24FDB1EC9872', N'FCT')
INSERT [dbo].[tbl_Nature_of_Application] ([ID], [RC_Number], [Company_Name], [Company_Type], [Payment_Reference], [Nature], [Nature_Reference], [Transaction_ID], [State_Code]) VALUES (9, N'12233', N'ABC Limited', N'Limited Liability Company', N'R-70005055078345', N'Annual Returns', N'N-251CA0083E3413', N'960625FF6BB7E8CBF06B', N'FCT')
INSERT [dbo].[tbl_Nature_of_Application] ([ID], [RC_Number], [Company_Name], [Company_Type], [Payment_Reference], [Nature], [Nature_Reference], [Transaction_ID], [State_Code]) VALUES (10, N'12233', N'ABC Limited', N'Limited Liability Company', N'R-70005055078345', N'Increase', N'N-251CA0083E3413', N'960625FF6BB7E8CBF06B', N'FCT')
INSERT [dbo].[tbl_Nature_of_Application] ([ID], [RC_Number], [Company_Name], [Company_Type], [Payment_Reference], [Nature], [Nature_Reference], [Transaction_ID], [State_Code]) VALUES (11, N'909090', N'XYZ Ventures', N'Business Names', N'R-D60A54A39CC285', N'Notice of Change in Business Names', N'N-F1D3DD27E24477', N'5EDD4FADFF045AAA3F95', N'FCT')
INSERT [dbo].[tbl_Nature_of_Application] ([ID], [RC_Number], [Company_Name], [Company_Type], [Payment_Reference], [Nature], [Nature_Reference], [Transaction_ID], [State_Code]) VALUES (12, N'909090', N'XYZ Ventures', N'Business Names', N'R-D60A54A39CC285', N'Notice of Cessation of Business', N'N-F1D3DD27E24477', N'5EDD4FADFF045AAA3F95', N'FCT')
SET IDENTITY_INSERT [dbo].[tbl_Nature_of_Application] OFF
GO
SET IDENTITY_INSERT [dbo].[tbl_Receive_Post_Applications] ON 

INSERT [dbo].[tbl_Receive_Post_Applications] ([Index], [MR_Batch_Ref], [Company_Name], [RC_Number], [Company_Type], [Nature_Reference], [Presenter_Name], [Presenter_Phone], [Presenter_Email], [Courier_Incoming], [Date_Received], [Destinating_Dept], [Forwarding_Date], [Forwarded_By], [Courier_Outgoing], [Payment_Reference], [No_of_Copies], [Details], [Confirmed_By_FinAcc], [Audited], [Task_Status], [Transaction_ID], [State_Code]) VALUES (3, N'FCT-RGO-04122020181758-PRE-B-1', N'ABC Limited', N'12233', N'Limited Liability Company', N'N-3B601A658EF717', N'Yassir Yahaya', N'08034457878', N'yymail@gmail.com', N'Box1', CAST(N'2020-12-04T00:00:00.000' AS DateTime), N'Business Names', CAST(N'2020-12-04T19:29:12.077' AS DateTime), N'yasir', N'DHL', N'R-4BF3D91B6FCCC7', 1, N'Just testing this stuff whether it works or not.', 0, 0, 0, N'D18748C462CA8FE3B40C', N'FCT')
INSERT [dbo].[tbl_Receive_Post_Applications] ([Index], [MR_Batch_Ref], [Company_Name], [RC_Number], [Company_Type], [Nature_Reference], [Presenter_Name], [Presenter_Phone], [Presenter_Email], [Courier_Incoming], [Date_Received], [Destinating_Dept], [Forwarding_Date], [Forwarded_By], [Courier_Outgoing], [Payment_Reference], [No_of_Copies], [Details], [Confirmed_By_FinAcc], [Audited], [Task_Status], [Transaction_ID], [State_Code]) VALUES (4, N'FCT-RGO-04122020181758-PRE-B-1', N'XYZ Ventures', N'909090', N'Business Names', N'N-D8AFF82FBFFCB1', N'Yunusa Yahaya', N'08034456767', N'yunusamaulud@gmail.com', N'EMS', CAST(N'2020-12-05T00:00:00.000' AS DateTime), N'Compliance', CAST(N'2020-12-04T19:29:12.117' AS DateTime), N'yasir', N'Sultan', N'R-E6F7E2C2FF7F72', 1, N'I hope it works.', 0, 0, 0, N'A53A3F6E24FDB1EC9872', N'FCT')
INSERT [dbo].[tbl_Receive_Post_Applications] ([Index], [MR_Batch_Ref], [Company_Name], [RC_Number], [Company_Type], [Nature_Reference], [Presenter_Name], [Presenter_Phone], [Presenter_Email], [Courier_Incoming], [Date_Received], [Destinating_Dept], [Forwarding_Date], [Forwarded_By], [Courier_Outgoing], [Payment_Reference], [No_of_Copies], [Details], [Confirmed_By_FinAcc], [Audited], [Task_Status], [Transaction_ID], [State_Code]) VALUES (5, N'FCT-RGO-04122020181758-PRE-B-1', N'ABC Limited', N'12233', N'Limited Liability Company', N'N-251CA0083E3413', N'Yassir Yahaya', N'08034457878', N'yymail@gmail.com', N'Box1', CAST(N'2020-12-04T00:00:00.000' AS DateTime), N'Business Names', CAST(N'2020-12-04T20:07:42.843' AS DateTime), N'yasir', N'DHL', N'R-70005055078345', 1, N'Just testing this stuff whether it works or not.', 0, 0, 0, N'960625FF6BB7E8CBF06B', N'FCT')
INSERT [dbo].[tbl_Receive_Post_Applications] ([Index], [MR_Batch_Ref], [Company_Name], [RC_Number], [Company_Type], [Nature_Reference], [Presenter_Name], [Presenter_Phone], [Presenter_Email], [Courier_Incoming], [Date_Received], [Destinating_Dept], [Forwarding_Date], [Forwarded_By], [Courier_Outgoing], [Payment_Reference], [No_of_Copies], [Details], [Confirmed_By_FinAcc], [Audited], [Task_Status], [Transaction_ID], [State_Code]) VALUES (6, N'FCT-RGO-04122020181758-PRE-B-1', N'XYZ Ventures', N'909090', N'Business Names', N'N-F1D3DD27E24477', N'Yunusa Yahaya', N'08034456767', N'yunusamaulud@gmail.com', N'EMS', CAST(N'2020-12-05T00:00:00.000' AS DateTime), N'Compliance', CAST(N'2020-12-04T20:07:42.913' AS DateTime), N'yasir', N'Sultan', N'R-D60A54A39CC285', 1, N'I hope it works.', 0, 0, 0, N'5EDD4FADFF045AAA3F95', N'FCT')
SET IDENTITY_INSERT [dbo].[tbl_Receive_Post_Applications] OFF
GO
SET IDENTITY_INSERT [dbo].[tbl_Registry] ON 

INSERT [dbo].[tbl_Registry] ([Index_ID], [Serial_No], [RC_Number], [Company_Name], [Company_Type], [REG_Batch], [Received_From_RGO_On], [RGO_Batch], [REG_Manifest_Prepared_By], [REG_Manifest_Preparation_Date], [REG_Despatch_Status], [MR_Received_By], [MR_Receiving_Date], [State_Code]) VALUES (38, N'111111', N'101010', N'ABC', N'LLC', N'FCT-REG-03032021112602-PRE-B-1', CAST(N'2021-03-03T11:23:53.503' AS DateTime), N'FCT-RGO-03032021111600-PRE-B-1', N'zyahaya', CAST(N'2021-03-03T11:27:17.510' AS DateTime), N'A-B-MR', N'kyahaya', CAST(N'2021-03-03T11:28:20.890' AS DateTime), N'FCT')
INSERT [dbo].[tbl_Registry] ([Index_ID], [Serial_No], [RC_Number], [Company_Name], [Company_Type], [REG_Batch], [Received_From_RGO_On], [RGO_Batch], [REG_Manifest_Prepared_By], [REG_Manifest_Preparation_Date], [REG_Despatch_Status], [MR_Received_By], [MR_Receiving_Date], [State_Code]) VALUES (39, N'222222', N'202020', N'KLM', N'LLC', N'FCT-REG-03032021112602-PRE-B-1', CAST(N'2021-03-03T11:23:53.503' AS DateTime), N'FCT-RGO-03032021111600-PRE-B-1', N'zyahaya', CAST(N'2021-03-03T11:27:17.510' AS DateTime), N'A-B-MR', N'kyahaya', CAST(N'2021-03-03T11:28:33.720' AS DateTime), N'FCT')
INSERT [dbo].[tbl_Registry] ([Index_ID], [Serial_No], [RC_Number], [Company_Name], [Company_Type], [REG_Batch], [Received_From_RGO_On], [RGO_Batch], [REG_Manifest_Prepared_By], [REG_Manifest_Preparation_Date], [REG_Despatch_Status], [MR_Received_By], [MR_Receiving_Date], [State_Code]) VALUES (40, N'333333', N'303030', N'XYZ', N'LLC', N'FCT-REG-03032021112602-PRE-B-1', CAST(N'2021-03-03T11:23:53.507' AS DateTime), N'FCT-RGO-03032021111600-PRE-B-1', N'zyahaya', CAST(N'2021-03-03T11:27:17.510' AS DateTime), N'A-B-MR', N'kyahaya', CAST(N'2021-03-03T11:28:33.720' AS DateTime), N'FCT')
INSERT [dbo].[tbl_Registry] ([Index_ID], [Serial_No], [RC_Number], [Company_Name], [Company_Type], [REG_Batch], [Received_From_RGO_On], [RGO_Batch], [REG_Manifest_Prepared_By], [REG_Manifest_Preparation_Date], [REG_Despatch_Status], [MR_Received_By], [MR_Receiving_Date], [State_Code]) VALUES (41, N'121212', N'1163911', N'Kaiglo Stores Limited', N'LLC', N'FCT-REG-08032021110814-PRE-B-1', CAST(N'2021-03-08T11:07:52.733' AS DateTime), N'FCT-RGO-08032021110436-PRE-B-1', N'zyahaya', CAST(N'2021-03-08T11:08:21.037' AS DateTime), N'A-B-MR', N'kyahaya', CAST(N'2021-03-08T11:09:36.050' AS DateTime), N'FCT')
INSERT [dbo].[tbl_Registry] ([Index_ID], [Serial_No], [RC_Number], [Company_Name], [Company_Type], [REG_Batch], [Received_From_RGO_On], [RGO_Batch], [REG_Manifest_Prepared_By], [REG_Manifest_Preparation_Date], [REG_Despatch_Status], [MR_Received_By], [MR_Receiving_Date], [State_Code]) VALUES (42, N'232211', N'98711', N'AZEX', N'LLC', N'FCT-REG-10082021085621-PRE-B-1', CAST(N'2021-08-10T08:55:52.720' AS DateTime), N'FCT-RGO-10082021085213-PRE-B-1', N'zyahaya', CAST(N'2021-08-10T08:56:27.743' AS DateTime), N'A-B-MR', N'kyahaya', CAST(N'2021-08-10T08:57:21.607' AS DateTime), N'FCT')
INSERT [dbo].[tbl_Registry] ([Index_ID], [Serial_No], [RC_Number], [Company_Name], [Company_Type], [REG_Batch], [Received_From_RGO_On], [RGO_Batch], [REG_Manifest_Prepared_By], [REG_Manifest_Preparation_Date], [REG_Despatch_Status], [MR_Received_By], [MR_Receiving_Date], [State_Code]) VALUES (43, N'990032', N'456790', N'RAVE', N'LLC', N'FCT-REG-10082021085621-PRE-B-1', CAST(N'2021-08-10T08:55:52.720' AS DateTime), N'FCT-RGO-10082021085213-PRE-B-1', N'zyahaya', CAST(N'2021-08-10T08:56:27.743' AS DateTime), N'A-B-MR', N'kyahaya', CAST(N'2021-08-10T08:57:21.607' AS DateTime), N'FCT')
SET IDENTITY_INSERT [dbo].[tbl_Registry] OFF
GO
SET IDENTITY_INSERT [dbo].[tbl_RGs_office] ON 

INSERT [dbo].[tbl_RGs_office] ([Index_ID], [Serial_No], [RC_Number], [Company_Name], [Company_Type], [Pre_or_Post], [RGO_Batch], [RGO_Cert_Gen_Date], [RGO_Cert_Despatch_Date], [RGO_Cert_Despatched_By], [RGO_Despatch_Status], [REG_Received_By], [REG_Receiving_Date], [IT_Received_By], [IT_Receiving_Date], [State_Code]) VALUES (20055, N'111111', N'101010', N'ABC', N'LLC', N'PRE', N'FCT-RGO-03032021111600-PRE-B-1', CAST(N'2021-03-03T00:00:00.000' AS DateTime), CAST(N'2021-03-03T11:22:29.383' AS DateTime), N'yyahaya', N'A-B-R', N'zyahaya', CAST(N'2021-03-03T11:23:53.503' AS DateTime), NULL, NULL, N'FCT')
INSERT [dbo].[tbl_RGs_office] ([Index_ID], [Serial_No], [RC_Number], [Company_Name], [Company_Type], [Pre_or_Post], [RGO_Batch], [RGO_Cert_Gen_Date], [RGO_Cert_Despatch_Date], [RGO_Cert_Despatched_By], [RGO_Despatch_Status], [REG_Received_By], [REG_Receiving_Date], [IT_Received_By], [IT_Receiving_Date], [State_Code]) VALUES (20056, N'222222', N'202020', N'KLM', N'LLC', N'PRE', N'FCT-RGO-03032021111600-PRE-B-1', CAST(N'2021-03-03T00:00:00.000' AS DateTime), CAST(N'2021-03-03T11:22:29.387' AS DateTime), N'yyahaya', N'A-B-R', N'zyahaya', CAST(N'2021-03-03T11:23:53.503' AS DateTime), NULL, NULL, N'FCT')
INSERT [dbo].[tbl_RGs_office] ([Index_ID], [Serial_No], [RC_Number], [Company_Name], [Company_Type], [Pre_or_Post], [RGO_Batch], [RGO_Cert_Gen_Date], [RGO_Cert_Despatch_Date], [RGO_Cert_Despatched_By], [RGO_Despatch_Status], [REG_Received_By], [REG_Receiving_Date], [IT_Received_By], [IT_Receiving_Date], [State_Code]) VALUES (20057, N'333333', N'303030', N'XYZ', N'LLC', N'PRE', N'FCT-RGO-03032021111600-PRE-B-1', CAST(N'2021-03-03T00:00:00.000' AS DateTime), CAST(N'2021-03-03T11:22:29.387' AS DateTime), N'yyahaya', N'A-B-R', N'zyahaya', CAST(N'2021-03-03T11:23:53.507' AS DateTime), NULL, NULL, N'FCT')
INSERT [dbo].[tbl_RGs_office] ([Index_ID], [Serial_No], [RC_Number], [Company_Name], [Company_Type], [Pre_or_Post], [RGO_Batch], [RGO_Cert_Gen_Date], [RGO_Cert_Despatch_Date], [RGO_Cert_Despatched_By], [RGO_Despatch_Status], [REG_Received_By], [REG_Receiving_Date], [IT_Received_By], [IT_Receiving_Date], [State_Code]) VALUES (20058, N'121212', N'1163911', N'Kaiglo Stores Limited', N'LLC', N'PRE', N'FCT-RGO-08032021110436-PRE-B-1', CAST(N'2021-03-08T00:00:00.000' AS DateTime), CAST(N'2021-03-08T11:06:45.980' AS DateTime), N'yyahaya', N'A-B-R', N'zyahaya', CAST(N'2021-03-08T11:07:52.733' AS DateTime), NULL, NULL, N'FCT')
INSERT [dbo].[tbl_RGs_office] ([Index_ID], [Serial_No], [RC_Number], [Company_Name], [Company_Type], [Pre_or_Post], [RGO_Batch], [RGO_Cert_Gen_Date], [RGO_Cert_Despatch_Date], [RGO_Cert_Despatched_By], [RGO_Despatch_Status], [REG_Received_By], [REG_Receiving_Date], [IT_Received_By], [IT_Receiving_Date], [State_Code]) VALUES (20059, N'232211', N'98711', N'AZEX', N'LLC', N'PRE', N'FCT-RGO-10082021085213-PRE-B-1', CAST(N'2021-08-10T00:00:00.000' AS DateTime), CAST(N'2021-08-10T08:53:29.000' AS DateTime), N'yyahaya', N'A-B-R', N'zyahaya', CAST(N'2021-08-10T08:55:52.720' AS DateTime), NULL, NULL, N'FCT')
INSERT [dbo].[tbl_RGs_office] ([Index_ID], [Serial_No], [RC_Number], [Company_Name], [Company_Type], [Pre_or_Post], [RGO_Batch], [RGO_Cert_Gen_Date], [RGO_Cert_Despatch_Date], [RGO_Cert_Despatched_By], [RGO_Despatch_Status], [REG_Received_By], [REG_Receiving_Date], [IT_Received_By], [IT_Receiving_Date], [State_Code]) VALUES (20060, N'990032', N'456790', N'RAVE', N'LLC', N'PRE', N'FCT-RGO-10082021085213-PRE-B-1', CAST(N'2021-08-10T00:00:00.000' AS DateTime), CAST(N'2021-08-10T08:53:29.003' AS DateTime), N'yyahaya', N'A-B-R', N'zyahaya', CAST(N'2021-08-10T08:55:52.720' AS DateTime), NULL, NULL, N'FCT')
INSERT [dbo].[tbl_RGs_office] ([Index_ID], [Serial_No], [RC_Number], [Company_Name], [Company_Type], [Pre_or_Post], [RGO_Batch], [RGO_Cert_Gen_Date], [RGO_Cert_Despatch_Date], [RGO_Cert_Despatched_By], [RGO_Despatch_Status], [REG_Received_By], [REG_Receiving_Date], [IT_Received_By], [IT_Receiving_Date], [State_Code]) VALUES (20061, N'1001001', N'202056', N'Hijaz Holdings', N'LLC', N'PRE', N'FCT-RGO-06092021115541-PRE-B-1', CAST(N'2021-09-07T00:00:00.000' AS DateTime), CAST(N'2021-09-06T11:56:37.913' AS DateTime), N'yyahaya', N'S-T-R', NULL, NULL, NULL, NULL, N'FCT')
INSERT [dbo].[tbl_RGs_office] ([Index_ID], [Serial_No], [RC_Number], [Company_Name], [Company_Type], [Pre_or_Post], [RGO_Batch], [RGO_Cert_Gen_Date], [RGO_Cert_Despatch_Date], [RGO_Cert_Despatched_By], [RGO_Despatch_Status], [REG_Received_By], [REG_Receiving_Date], [IT_Received_By], [IT_Receiving_Date], [State_Code]) VALUES (20062, N'23990', N'999921', N'Dulh Layl', N'LLC', N'PRE', N'FCT-RGO-06092021120229-PRE-B-2', CAST(N'2021-09-06T00:00:00.000' AS DateTime), CAST(N'2021-09-06T12:02:52.113' AS DateTime), N'yyahaya', N'S-T-R', NULL, NULL, NULL, NULL, N'FCT')
INSERT [dbo].[tbl_RGs_office] ([Index_ID], [Serial_No], [RC_Number], [Company_Name], [Company_Type], [Pre_or_Post], [RGO_Batch], [RGO_Cert_Gen_Date], [RGO_Cert_Despatch_Date], [RGO_Cert_Despatched_By], [RGO_Despatch_Status], [REG_Received_By], [REG_Receiving_Date], [IT_Received_By], [IT_Receiving_Date], [State_Code]) VALUES (20063, N'398389', N'200231', N'Daz Dillinger', N'LLC', N'PRE', N'FCT-RGO-06092021120305-PRE-B-3', CAST(N'2021-09-16T00:00:00.000' AS DateTime), CAST(N'2021-09-06T12:12:42.220' AS DateTime), N'yyahaya', N'S-T-R', NULL, NULL, NULL, NULL, N'FCT')
SET IDENTITY_INSERT [dbo].[tbl_RGs_office] OFF
GO
SET IDENTITY_INSERT [dbo].[tbl_RRR_History] ON 

INSERT [dbo].[tbl_RRR_History] ([ID], [RRR_Number], [Amount], [RC_Number], [Date_Captured], [Payment_Reference], [Transaction_ID], [State_Code]) VALUES (5, N'121212', 1000.0000, N'12233', CAST(N'2020-12-04T19:29:12.103' AS DateTime), N'R-4BF3D91B6FCCC7', N'D18748C462CA8FE3B40C', N'FCT')
INSERT [dbo].[tbl_RRR_History] ([ID], [RRR_Number], [Amount], [RC_Number], [Date_Captured], [Payment_Reference], [Transaction_ID], [State_Code]) VALUES (6, N'232323', 2000.0000, N'12233', CAST(N'2020-12-04T19:29:12.103' AS DateTime), N'R-4BF3D91B6FCCC7', N'D18748C462CA8FE3B40C', N'FCT')
INSERT [dbo].[tbl_RRR_History] ([ID], [RRR_Number], [Amount], [RC_Number], [Date_Captured], [Payment_Reference], [Transaction_ID], [State_Code]) VALUES (7, N'333333', 1500.0000, N'909090', CAST(N'2020-12-04T19:29:12.123' AS DateTime), N'R-E6F7E2C2FF7F72', N'A53A3F6E24FDB1EC9872', N'FCT')
INSERT [dbo].[tbl_RRR_History] ([ID], [RRR_Number], [Amount], [RC_Number], [Date_Captured], [Payment_Reference], [Transaction_ID], [State_Code]) VALUES (8, N'444444', 2500.0000, N'909090', CAST(N'2020-12-04T19:29:12.123' AS DateTime), N'R-E6F7E2C2FF7F72', N'A53A3F6E24FDB1EC9872', N'FCT')
INSERT [dbo].[tbl_RRR_History] ([ID], [RRR_Number], [Amount], [RC_Number], [Date_Captured], [Payment_Reference], [Transaction_ID], [State_Code]) VALUES (9, N'121212', 1000.0000, N'12233', CAST(N'2020-12-04T20:07:42.893' AS DateTime), N'R-70005055078345', N'960625FF6BB7E8CBF06B', N'FCT')
INSERT [dbo].[tbl_RRR_History] ([ID], [RRR_Number], [Amount], [RC_Number], [Date_Captured], [Payment_Reference], [Transaction_ID], [State_Code]) VALUES (10, N'232323', 2000.0000, N'12233', CAST(N'2020-12-04T20:07:42.897' AS DateTime), N'R-70005055078345', N'960625FF6BB7E8CBF06B', N'FCT')
INSERT [dbo].[tbl_RRR_History] ([ID], [RRR_Number], [Amount], [RC_Number], [Date_Captured], [Payment_Reference], [Transaction_ID], [State_Code]) VALUES (11, N'333333', 1500.0000, N'909090', CAST(N'2020-12-04T20:07:42.917' AS DateTime), N'R-D60A54A39CC285', N'5EDD4FADFF045AAA3F95', N'FCT')
INSERT [dbo].[tbl_RRR_History] ([ID], [RRR_Number], [Amount], [RC_Number], [Date_Captured], [Payment_Reference], [Transaction_ID], [State_Code]) VALUES (12, N'444444', 2500.0000, N'909090', CAST(N'2020-12-04T20:07:42.917' AS DateTime), N'R-D60A54A39CC285', N'5EDD4FADFF045AAA3F95', N'FCT')
SET IDENTITY_INSERT [dbo].[tbl_RRR_History] OFF
GO
SET IDENTITY_INSERT [dbo].[tbl_Schedule_officers] ON 

INSERT [dbo].[tbl_Schedule_officers] ([Index_ID], [First_Name], [Surname], [Department], [Role], [Login_ID], [Login_Password], [Is_Active], [State_Code], [Email], [Password_Recovery_Code], [New_Account_Refcode], [Date_Requested], [Date_Approved], [Email_Verified]) VALUES (1, N'Yassir', N'Yahaya', N'RGs Office', N'Pre Incorporation', N'yyahaya', N'121211', N'1', N'FCT', N'yassir2k@gmail.com', N'463bcb5d9f0afe57c010b84ed72be8c8', NULL, NULL, NULL, NULL)
INSERT [dbo].[tbl_Schedule_officers] ([Index_ID], [First_Name], [Surname], [Department], [Role], [Login_ID], [Login_Password], [Is_Active], [State_Code], [Email], [Password_Recovery_Code], [New_Account_Refcode], [Date_Requested], [Date_Approved], [Email_Verified]) VALUES (2, N'Zayyan', N'Yahaya', N'Registry', N'Pre Incorporation', N'zyahaya', N'123456', N'1', N'FCT', NULL, NULL, NULL, NULL, NULL, NULL)
INSERT [dbo].[tbl_Schedule_officers] ([Index_ID], [First_Name], [Surname], [Department], [Role], [Login_ID], [Login_Password], [Is_Active], [State_Code], [Email], [Password_Recovery_Code], [New_Account_Refcode], [Date_Requested], [Date_Approved], [Email_Verified]) VALUES (3, N'Kamaludeen', N'Yahaya', N'Mail Room', N'Pre Incorporation', N'kyahaya', N'123456', N'1', N'FCT', NULL, NULL, NULL, NULL, NULL, NULL)
INSERT [dbo].[tbl_Schedule_officers] ([Index_ID], [First_Name], [Surname], [Department], [Role], [Login_ID], [Login_Password], [Is_Active], [State_Code], [Email], [Password_Recovery_Code], [New_Account_Refcode], [Date_Requested], [Date_Approved], [Email_Verified]) VALUES (4, N'Amma', N'Yassir', N'RGs Office', N'Pre Incorporation', N'ammay', N'123456', N'1', N'AD', NULL, NULL, NULL, NULL, NULL, NULL)
INSERT [dbo].[tbl_Schedule_officers] ([Index_ID], [First_Name], [Surname], [Department], [Role], [Login_ID], [Login_Password], [Is_Active], [State_Code], [Email], [Password_Recovery_Code], [New_Account_Refcode], [Date_Requested], [Date_Approved], [Email_Verified]) VALUES (10004, N'Juwairiyyah', N'Usman', N'Trustees', N'Pre Incorporation', N'jusman', N'123456', N'1', N'FCT', NULL, NULL, NULL, NULL, NULL, NULL)
INSERT [dbo].[tbl_Schedule_officers] ([Index_ID], [First_Name], [Surname], [Department], [Role], [Login_ID], [Login_Password], [Is_Active], [State_Code], [Email], [Password_Recovery_Code], [New_Account_Refcode], [Date_Requested], [Date_Approved], [Email_Verified]) VALUES (10005, N'Usman', N'Lawal Audi', N'Business Names', N'Pre Incorporation', N'ulaudi', N'123456', N'1', N'FCT', NULL, NULL, NULL, NULL, NULL, NULL)
INSERT [dbo].[tbl_Schedule_officers] ([Index_ID], [First_Name], [Surname], [Department], [Role], [Login_ID], [Login_Password], [Is_Active], [State_Code], [Email], [Password_Recovery_Code], [New_Account_Refcode], [Date_Requested], [Date_Approved], [Email_Verified]) VALUES (10008, N'Yasir', N'Yahya', N'Mail Room', N'Post Incorporation', N'yasir', N'123456', N'1', N'FCT', N'yyahaya@cac.gov.ng', NULL, NULL, NULL, NULL, NULL)
INSERT [dbo].[tbl_Schedule_officers] ([Index_ID], [First_Name], [Surname], [Department], [Role], [Login_ID], [Login_Password], [Is_Active], [State_Code], [Email], [Password_Recovery_Code], [New_Account_Refcode], [Date_Requested], [Date_Approved], [Email_Verified]) VALUES (10009, N'Finance', N'Account', N'Finance', N'Post Incorporation', N'finacc', N'123456', N'1', N'FCT', NULL, NULL, NULL, NULL, NULL, NULL)
SET IDENTITY_INSERT [dbo].[tbl_Schedule_officers] OFF
GO
INSERT [dbo].[tbl_States] ([State_Code], [State_Name]) VALUES (N'AB', N'Abia')
INSERT [dbo].[tbl_States] ([State_Code], [State_Name]) VALUES (N'AD', N'Adamawa')
INSERT [dbo].[tbl_States] ([State_Code], [State_Name]) VALUES (N'AK', N'Akwa Ibom')
INSERT [dbo].[tbl_States] ([State_Code], [State_Name]) VALUES (N'AN', N'Anambra')
INSERT [dbo].[tbl_States] ([State_Code], [State_Name]) VALUES (N'BA', N'Bauchi')
INSERT [dbo].[tbl_States] ([State_Code], [State_Name]) VALUES (N'BE', N'Benue')
INSERT [dbo].[tbl_States] ([State_Code], [State_Name]) VALUES (N'BO', N'Borno')
INSERT [dbo].[tbl_States] ([State_Code], [State_Name]) VALUES (N'BY', N'Bayelsa')
INSERT [dbo].[tbl_States] ([State_Code], [State_Name]) VALUES (N'CR', N'Cross River')
INSERT [dbo].[tbl_States] ([State_Code], [State_Name]) VALUES (N'DE', N'Delta')
INSERT [dbo].[tbl_States] ([State_Code], [State_Name]) VALUES (N'EB', N'Ebonyi')
INSERT [dbo].[tbl_States] ([State_Code], [State_Name]) VALUES (N'ED', N'Edo')
INSERT [dbo].[tbl_States] ([State_Code], [State_Name]) VALUES (N'EK', N'Ekiti')
INSERT [dbo].[tbl_States] ([State_Code], [State_Name]) VALUES (N'EN', N'Enugu')
INSERT [dbo].[tbl_States] ([State_Code], [State_Name]) VALUES (N'FCT', N'Abuja HQ')
INSERT [dbo].[tbl_States] ([State_Code], [State_Name]) VALUES (N'GM', N'Gombe')
INSERT [dbo].[tbl_States] ([State_Code], [State_Name]) VALUES (N'IM', N'Imo')
INSERT [dbo].[tbl_States] ([State_Code], [State_Name]) VALUES (N'JG', N'Jigawa')
INSERT [dbo].[tbl_States] ([State_Code], [State_Name]) VALUES (N'KB', N'Kebbi')
INSERT [dbo].[tbl_States] ([State_Code], [State_Name]) VALUES (N'KD', N'Kaduna')
INSERT [dbo].[tbl_States] ([State_Code], [State_Name]) VALUES (N'KG', N'Kogi')
INSERT [dbo].[tbl_States] ([State_Code], [State_Name]) VALUES (N'KN', N'Kano')
INSERT [dbo].[tbl_States] ([State_Code], [State_Name]) VALUES (N'KT', N'Katsina')
INSERT [dbo].[tbl_States] ([State_Code], [State_Name]) VALUES (N'KW', N'Kwara')
INSERT [dbo].[tbl_States] ([State_Code], [State_Name]) VALUES (N'LA1', N'Lagos Alausa')
INSERT [dbo].[tbl_States] ([State_Code], [State_Name]) VALUES (N'LA2', N'Lagos Island')
INSERT [dbo].[tbl_States] ([State_Code], [State_Name]) VALUES (N'NG', N'Niger')
INSERT [dbo].[tbl_States] ([State_Code], [State_Name]) VALUES (N'NS', N'Nassarawa')
INSERT [dbo].[tbl_States] ([State_Code], [State_Name]) VALUES (N'OD', N'Ondo')
INSERT [dbo].[tbl_States] ([State_Code], [State_Name]) VALUES (N'OG', N'Ogun')
INSERT [dbo].[tbl_States] ([State_Code], [State_Name]) VALUES (N'OS', N'Osun')
INSERT [dbo].[tbl_States] ([State_Code], [State_Name]) VALUES (N'OY', N'Oyo')
INSERT [dbo].[tbl_States] ([State_Code], [State_Name]) VALUES (N'PL', N'Plateau')
INSERT [dbo].[tbl_States] ([State_Code], [State_Name]) VALUES (N'RV', N'Rivers')
INSERT [dbo].[tbl_States] ([State_Code], [State_Name]) VALUES (N'SK', N'Sokoto')
INSERT [dbo].[tbl_States] ([State_Code], [State_Name]) VALUES (N'TR', N'Taraba')
INSERT [dbo].[tbl_States] ([State_Code], [State_Name]) VALUES (N'YB', N'Yobe')
INSERT [dbo].[tbl_States] ([State_Code], [State_Name]) VALUES (N'Z5', N'Abuja Zone 5')
INSERT [dbo].[tbl_States] ([State_Code], [State_Name]) VALUES (N'ZM', N'Zamfara')
GO
ALTER TABLE [dbo].[tbl_Batches_History]  WITH CHECK ADD  CONSTRAINT [tbl_States_tbl_Batches_History] FOREIGN KEY([State_Code])
REFERENCES [dbo].[tbl_States] ([State_Code])
GO
ALTER TABLE [dbo].[tbl_Batches_History] CHECK CONSTRAINT [tbl_States_tbl_Batches_History]
GO
ALTER TABLE [dbo].[tbl_Business_Names]  WITH CHECK ADD  CONSTRAINT [tbl_States_tbl_Business_names] FOREIGN KEY([State_Code])
REFERENCES [dbo].[tbl_States] ([State_Code])
GO
ALTER TABLE [dbo].[tbl_Business_Names] CHECK CONSTRAINT [tbl_States_tbl_Business_names]
GO
ALTER TABLE [dbo].[tbl_Business_Names_Post]  WITH CHECK ADD  CONSTRAINT [tbl_States_tbl_Business_Names_Post] FOREIGN KEY([State_Code])
REFERENCES [dbo].[tbl_States] ([State_Code])
GO
ALTER TABLE [dbo].[tbl_Business_Names_Post] CHECK CONSTRAINT [tbl_States_tbl_Business_Names_Post]
GO
ALTER TABLE [dbo].[tbl_Compliance_Post]  WITH CHECK ADD  CONSTRAINT [tbl_States_tbl_Compliance_Post] FOREIGN KEY([State_Code])
REFERENCES [dbo].[tbl_States] ([State_Code])
GO
ALTER TABLE [dbo].[tbl_Compliance_Post] CHECK CONSTRAINT [tbl_States_tbl_Compliance_Post]
GO
ALTER TABLE [dbo].[tbl_Courier_Companies]  WITH CHECK ADD  CONSTRAINT [tbl_States_tbl_Courier_Companies] FOREIGN KEY([State_Code])
REFERENCES [dbo].[tbl_States] ([State_Code])
GO
ALTER TABLE [dbo].[tbl_Courier_Companies] CHECK CONSTRAINT [tbl_States_tbl_Courier_Companies]
GO
ALTER TABLE [dbo].[tbl_Customer_Service_Post]  WITH CHECK ADD  CONSTRAINT [tbl_States_tbl_Customer_Service_Post] FOREIGN KEY([State_Code])
REFERENCES [dbo].[tbl_States] ([State_Code])
GO
ALTER TABLE [dbo].[tbl_Customer_Service_Post] CHECK CONSTRAINT [tbl_States_tbl_Customer_Service_Post]
GO
ALTER TABLE [dbo].[tbl_Finance]  WITH CHECK ADD  CONSTRAINT [tbl_States_tbl_Finance] FOREIGN KEY([State_Code])
REFERENCES [dbo].[tbl_States] ([State_Code])
GO
ALTER TABLE [dbo].[tbl_Finance] CHECK CONSTRAINT [tbl_States_tbl_Finance]
GO
ALTER TABLE [dbo].[tbl_Log]  WITH CHECK ADD  CONSTRAINT [tbl_States_tbl_Log] FOREIGN KEY([State_Code])
REFERENCES [dbo].[tbl_States] ([State_Code])
GO
ALTER TABLE [dbo].[tbl_Log] CHECK CONSTRAINT [tbl_States_tbl_Log]
GO
ALTER TABLE [dbo].[tbl_Mail_Room]  WITH CHECK ADD  CONSTRAINT [tbl_States_tbl_Mail_Room] FOREIGN KEY([State_Code])
REFERENCES [dbo].[tbl_States] ([State_Code])
GO
ALTER TABLE [dbo].[tbl_Mail_Room] CHECK CONSTRAINT [tbl_States_tbl_Mail_Room]
GO
ALTER TABLE [dbo].[tbl_MR_Post_Receive]  WITH CHECK ADD  CONSTRAINT [tbl_States_tbl_MR_Post_Receive] FOREIGN KEY([State_Code])
REFERENCES [dbo].[tbl_States] ([State_Code])
GO
ALTER TABLE [dbo].[tbl_MR_Post_Receive] CHECK CONSTRAINT [tbl_States_tbl_MR_Post_Receive]
GO
ALTER TABLE [dbo].[tbl_MR_Post_Send]  WITH CHECK ADD  CONSTRAINT [tbl_States_tbl_MR_Post_Send] FOREIGN KEY([State_Code])
REFERENCES [dbo].[tbl_States] ([State_Code])
GO
ALTER TABLE [dbo].[tbl_MR_Post_Send] CHECK CONSTRAINT [tbl_States_tbl_MR_Post_Send]
GO
ALTER TABLE [dbo].[tbl_Nature_of_Application]  WITH CHECK ADD  CONSTRAINT [tbl_States_tbl_Nature_of_Application] FOREIGN KEY([State_Code])
REFERENCES [dbo].[tbl_States] ([State_Code])
GO
ALTER TABLE [dbo].[tbl_Nature_of_Application] CHECK CONSTRAINT [tbl_States_tbl_Nature_of_Application]
GO
ALTER TABLE [dbo].[tbl_Receive_Post_Applications]  WITH CHECK ADD  CONSTRAINT [tbl_States_tbl_Receive_Post_Applications] FOREIGN KEY([State_Code])
REFERENCES [dbo].[tbl_States] ([State_Code])
GO
ALTER TABLE [dbo].[tbl_Receive_Post_Applications] CHECK CONSTRAINT [tbl_States_tbl_Receive_Post_Applications]
GO
ALTER TABLE [dbo].[tbl_Registry]  WITH CHECK ADD  CONSTRAINT [tbl_States_tbl_Registry] FOREIGN KEY([State_Code])
REFERENCES [dbo].[tbl_States] ([State_Code])
GO
ALTER TABLE [dbo].[tbl_Registry] CHECK CONSTRAINT [tbl_States_tbl_Registry]
GO
ALTER TABLE [dbo].[tbl_Registry_Post]  WITH CHECK ADD  CONSTRAINT [tbl_States_tbl_Registry_Post] FOREIGN KEY([State_Code])
REFERENCES [dbo].[tbl_States] ([State_Code])
GO
ALTER TABLE [dbo].[tbl_Registry_Post] CHECK CONSTRAINT [tbl_States_tbl_Registry_Post]
GO
ALTER TABLE [dbo].[tbl_RGs_office]  WITH CHECK ADD  CONSTRAINT [tbl_States_tbl_RGs_office] FOREIGN KEY([State_Code])
REFERENCES [dbo].[tbl_States] ([State_Code])
GO
ALTER TABLE [dbo].[tbl_RGs_office] CHECK CONSTRAINT [tbl_States_tbl_RGs_office]
GO
ALTER TABLE [dbo].[tbl_RRR_History]  WITH CHECK ADD  CONSTRAINT [tbl_States_tbl_RRR_History] FOREIGN KEY([State_Code])
REFERENCES [dbo].[tbl_States] ([State_Code])
GO
ALTER TABLE [dbo].[tbl_RRR_History] CHECK CONSTRAINT [tbl_States_tbl_RRR_History]
GO
ALTER TABLE [dbo].[tbl_Schedule_officers]  WITH CHECK ADD  CONSTRAINT [tbl_States_tbl_Schedule_officers] FOREIGN KEY([State_Code])
REFERENCES [dbo].[tbl_States] ([State_Code])
GO
ALTER TABLE [dbo].[tbl_Schedule_officers] CHECK CONSTRAINT [tbl_States_tbl_Schedule_officers]
GO
ALTER TABLE [dbo].[tbl_Trustees]  WITH CHECK ADD  CONSTRAINT [tbl_States_tbl_Trustees] FOREIGN KEY([State_Code])
REFERENCES [dbo].[tbl_States] ([State_Code])
GO
ALTER TABLE [dbo].[tbl_Trustees] CHECK CONSTRAINT [tbl_States_tbl_Trustees]
GO
ALTER TABLE [dbo].[tbl_Trustees_Post]  WITH CHECK ADD  CONSTRAINT [tbl_States_tbl_Trustees_Post] FOREIGN KEY([State_Code])
REFERENCES [dbo].[tbl_States] ([State_Code])
GO
ALTER TABLE [dbo].[tbl_Trustees_Post] CHECK CONSTRAINT [tbl_States_tbl_Trustees_Post]
GO
