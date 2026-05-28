<?php
    $host     = '185.94.230.178'; // Change if your database is on a different server
    $db       = 'manualsinepro_rfid-media-library';     // Your database name
    $user     = 'manualsinepro_rfid-media-librarian';         // Your database username
    $password = '#vNXPW@2slX4'; // Your database password
    $charset  = 'utf8mb4'; 

    // 2. SET UP THE PDO OPTIONS
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Turns errors into exceptions
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Fetches data as associative arrays
        PDO::ATTR_EMULATE_PREPARES   => false,                  // Turns off emulation for real security
    ];

    try {
        // 3. ESTABLISH THE CONNECTION
        $pdo = new PDO($dsn, $user, $password, $options);
        $pdo->query("DROP TABLE IF EXISTS Sample");
        $pdo->query("CREATE TABLE Sample (
            SampleDBIndex INT AUTO_INCREMENT PRIMARY KEY,
            SampleIndex INT NOT NULL,
            SampleBitsNumber VARCHAR(255),
            SampleBitsTotal VARCHAR(255),
            SampleTechCode VARCHAR(255) NOT NULL,
            SampleCommCode VARCHAR(255) NOT NULL,
            SampleOutput VARCHAR(255),
            SampleHex VARCHAR(255),
            SampleFCS VARCHAR(255),
            SampleFormatNotes VARCHAR(255),
            SampleTypeID VARCHAR(255),
            SampleConfigName VARCHAR(255)
        )");

/*        
        $pdo->query("DROP TABLE IF EXISTS Configuration");
        $pdo->query("CREATE TABLE Configuration (
            ConfigDBIndex INT AUTO_INCREMENT PRIMARY KEY,
            ConfigName VARCHAR(255) NOT NULL,
        )");
        $pdo->query("DROP TABLE IF EXISTS MediumType");
        $pdo->query("CREATE TABLE MediumType (
            MediumTypeDBIndex INT AUTO_INCREMENT PRIMARY KEY,
            MediumTypeName VARCHAR(255) NOT NULL,
            MediumTypeDescription VARCHAR(255),
            MediumTypeCode VARCHAR(255) NOT NULL
        )");
        $pdo->query("DROP TABLE IF EXISTS SampleSlot");
        $pdo->query("CREATE TABLE SampleSlot (
            SampleSlotDBIndex INT AUTO_INCREMENT PRIMARY KEY,
            SampleSlotName VARCHAR(255) NOT NULL
        )");
        $pdo->query("DROP TABLE IF EXISTS Brand");
        $pdo->query("CREATE TABLE Brand (
            BrandDBIndex INT AUTO_INCREMENT PRIMARY KEY,
            BrandName VARCHAR(255) NOT NULL
        )");
        $pdo->query("DROP TABLE IF EXISTS Color");
        $pdo->query("CREATE TABLE Color (
            ColorDBIndex INT AUTO_INCREMENT PRIMARY KEY,
            ColorName VARCHAR(255) NOT NULL
        )");
        $pdo->query("DROP TABLE IF EXISTS RFIDType");
        $pdo->query("CREATE TABLE RFIDType (
            RFIDTypeDBIndex INT AUTO_INCREMENT PRIMARY KEY,
            RFIDTypeName VARCHAR(255) NOT NULL,
            RFIDTypeCode VARCHAR(255)
        )");
        $pdo->query("DROP TABLE IF EXISTS Technology");
        $pdo->query("CREATE TABLE Technology (
            TechnologyDBIndex INT AUTO_INCREMENT PRIMARY KEY,
            TechnologyName VARCHAR(255) NOT NULL,
            TechnologyCode VARCHAR(255),
            TechnologyCardTypeID VARCHAR(255)
        )");

        /*
        $pdo->query("DROP TABLE IF EXISTS Media");
        $pdo->query("CREATE TABLE Media (
            MediaDBIndex INT AUTO_INCREMENT PRIMARY KEY,
            MediaIndex INT NOT NULL,
            MediumType VARCHAR(255) NOT NULL,
            PrimarySample int NOT NULL,
            CISCode VARCHAR(255) NOT NULL,
            Printed1 VARCHAR(255),
            Printed2 VARCHAR(255),
            Printed3 VARCHAR(255),
            Printed4 VARCHAR(255),
            Printed5 VARCHAR(255),
            Printed6 VARCHAR(255),
            Printed7 VARCHAR(255),
            Brand VARCHAR(255),
            Color VARCHAR(255),
            Sample1 int NOT NULL,
            Sample2 int,
            Sample3 int,
            Sample4 int
        )");
        */
        // 4. EXECUTE THE QUERY
        /*
        $pdo->exec("INSERT INTO Brand (BrandName) VALUES ('Suica')");
        $pdo->exec("INSERT INTO Brand (BrandName) VALUES ('Sodexo')");
        $pdo->exec("INSERT INTO Brand (BrandName) VALUES ('HID Global')");
        $pdo->exec("INSERT INTO Brand (BrandName) VALUES ('None')");
        $pdo->exec("INSERT INTO Color (ColorName) VALUES ('Black')");
        $pdo->exec("INSERT INTO Color (ColorName) VALUES ('Blue')");
        $pdo->exec("INSERT INTO Color (ColorName) VALUES ('Brand Design')");
        $pdo->exec("INSERT INTO Color (ColorName) VALUES ('Green')");
        $pdo->exec("INSERT INTO Color (ColorName) VALUES ('Grey')");
        $pdo->exec("INSERT INTO Color (ColorName) VALUES ('Metalic')");
        $pdo->exec("INSERT INTO Color (ColorName) VALUES ('None')");
        $pdo->exec("INSERT INTO Color (ColorName) VALUES ('Other')");
        $pdo->exec("INSERT INTO Color (ColorName) VALUES ('Red')");
        $pdo->exec("INSERT INTO Color (ColorName) VALUES ('Transparent')");
        $pdo->exec("INSERT INTO Color (ColorName) VALUES ('White')");
        $pdo->exec("INSERT INTO SampleSlot (SampleSlotName) VALUES ('Sample 1')");
        $pdo->exec("INSERT INTO SampleSlot (SampleSlotName) VALUES ('Sample 2')");
        $pdo->exec("INSERT INTO SampleSlot (SampleSlotName) VALUES ('Sample 3')");
        $pdo->exec("INSERT INTO SampleSlot (SampleSlotName) VALUES ('Sample 4')");
        $pdo->exec("INSERT INTO RFIDType (RFIDTypeName, RFIDTypeCode) VALUES ('13.56MHz (HF)', 'HIFR')");
        $pdo->exec("INSERT INTO RFIDType (RFIDTypeName, RFIDTypeCode) VALUES ('125kHz (LF)', 'LOFR')");
        $pdo->exec("INSERT INTO RFIDType (RFIDTypeName, RFIDTypeCode) VALUES ('Both 13.56MHz (HF) and 125kHz (LF)', 'BOTH')");
        $pdo->exec("INSERT INTO RFIDType (RFIDTypeName, RFIDTypeCode) VALUES ('None', 'NONE')");
        $pdo->exec("INSERT INTO RFIDType (RFIDTypeName, RFIDTypeCode) VALUES ('BLE', 'BLE_')");
        $pdo->exec("INSERT INTO RFIDType (RFIDTypeName, RFIDTypeCode) VALUES ('NFC', 'NFC_')");
        $pdo->exec("INSERT INTO RFIDType (RFIDTypeName, RFIDTypeCode) VALUES ('Both BLE and NFC', 'BTNC')");
        $pdo->exec("INSERT INTO Technology (TechnologyName, TechnologyCode, TechnologyCardTypeID) 
            VALUES ('None', 'NONE', '')");
        $pdo->exec("INSERT INTO Technology (TechnologyName, TechnologyCode, TechnologyCardTypeID) 
            VALUES ('Multi', 'MULTI', '')");
        $pdo->exec("INSERT INTO Technology (TechnologyName, TechnologyCode, TechnologyCardTypeID) 
            VALUES ('AWID', 'AWID', '')");
        $pdo->exec("INSERT INTO Technology (TechnologyName, TechnologyCode, TechnologyCardTypeID) 
            VALUES ('Cotag', 'COTG', '')");
        $pdo->exec("INSERT INTO Technology (TechnologyName, TechnologyCode, TechnologyCardTypeID) 
            VALUES ('Deister Electronics', 'DEIT', '')");
        $pdo->exec("INSERT INTO Technology (TechnologyName, TechnologyCode, TechnologyCardTypeID) 
            VALUES ('EM4x02/UNIQUE', 'UNIQ', '')");
        $pdo->exec("INSERT INTO Technology (TechnologyName, TechnologyCode, TechnologyCardTypeID) 
            VALUES ('EM4x50', 'EM50', '')");
        $pdo->exec("INSERT INTO Technology (TechnologyName, TechnologyCode, TechnologyCardTypeID) 
            VALUES ('FDX-B', 'FDXB', '')");
        $pdo->exec("INSERT INTO Technology (TechnologyName, TechnologyCode, TechnologyCardTypeID) 
            VALUES ('FeliCa', 'FELI', '')");
        $pdo->exec("INSERT INTO Technology (TechnologyName, TechnologyCode, TechnologyCardTypeID) 
            VALUES ('GPROXII', 'GPR2', '')");
        $pdo->exec("INSERT INTO Technology (TechnologyName, TechnologyCode, TechnologyCardTypeID) 
            VALUES ('HID iCLASS', 'HICL', '')");
        $pdo->exec("INSERT INTO Technology (TechnologyName, TechnologyCode, TechnologyCardTypeID) 
            VALUES ('HID iCLASS Seos', 'ICLS', '')");
        $pdo->exec("INSERT INTO Technology (TechnologyName, TechnologyCode, TechnologyCardTypeID) 
            VALUES ('HID Mobile Access', 'HIDM', '')");
        $pdo->exec("INSERT INTO Technology (TechnologyName, TechnologyCode, TechnologyCardTypeID) 
            VALUES ('HID Prox', 'HPRX', '')");
        $pdo->exec("INSERT INTO Technology (TechnologyName, TechnologyCode, TechnologyCardTypeID) 
            VALUES ('HITAG-1/HITAG-S', 'HIT1', '')");
        $pdo->exec("INSERT INTO Technology (TechnologyName, TechnologyCode, TechnologyCardTypeID) 
            VALUES ('HITAG-2', 'HIT2', '')");
        $pdo->exec("INSERT INTO Technology (TechnologyName, TechnologyCode, TechnologyCardTypeID) 
            VALUES ('IDTECK', 'IDTK', '')");
        $pdo->exec("INSERT INTO Technology (TechnologyName, TechnologyCode, TechnologyCardTypeID) 
            VALUES ('INDALA', 'INDA', '')");
        $pdo->exec("INSERT INTO Technology (TechnologyName, TechnologyCode, TechnologyCardTypeID) 
            VALUES ('ioProx', 'IOPX', '')");
        $pdo->exec("INSERT INTO Technology (TechnologyName, TechnologyCode, TechnologyCardTypeID) 
            VALUES ('ISO14443A', 'I43A', '')");
        $pdo->exec("INSERT INTO Technology (TechnologyName, TechnologyCode, TechnologyCardTypeID) 
            VALUES ('ISO14443B', 'I43B', '')");
        $pdo->exec("INSERT INTO Technology (TechnologyName, TechnologyCode, TechnologyCardTypeID) 
            VALUES ('ISO15693', 'I693', '')");
        $pdo->exec("INSERT INTO Technology (TechnologyName, TechnologyCode, TechnologyCardTypeID) 
            VALUES ('Isonas', 'ISON', '')");
        $pdo->exec("INSERT INTO Technology (TechnologyName, TechnologyCode, TechnologyCardTypeID) 
            VALUES ('Keri', 'KERI', '')");
        $pdo->exec("INSERT INTO Technology (TechnologyName, TechnologyCode, TechnologyCardTypeID) 
            VALUES ('Keri NXT', 'KERN', '')");
        $pdo->exec("INSERT INTO Technology (TechnologyName, TechnologyCode, TechnologyCardTypeID) 
            VALUES ('LEGIC Advant ISO14443A', 'LA3A', '')");
        $pdo->exec("INSERT INTO Technology (TechnologyName, TechnologyCode, TechnologyCardTypeID) 
            VALUES ('LEGIC Advant ISO15693', 'LA93', '')");
        $pdo->exec("INSERT INTO Technology (TechnologyName, TechnologyCode, TechnologyCardTypeID) 
            VALUES ('LEGIC Prime', 'LPRI', '')");
        $pdo->exec("INSERT INTO Technology (TechnologyName, TechnologyCode, TechnologyCardTypeID) 
            VALUES ('Mifare Classic', 'MCLA', '')");
        $pdo->exec("INSERT INTO Technology (TechnologyName, TechnologyCode, TechnologyCardTypeID) 
            VALUES ('Mifare DESFire EV0', 'MDF0', '')");
        $pdo->exec("INSERT INTO Technology (TechnologyName, TechnologyCode, TechnologyCardTypeID) 
            VALUES ('Mifare DESFire EV1', 'MDF1', '')");
        $pdo->exec("INSERT INTO Technology (TechnologyName, TechnologyCode, TechnologyCardTypeID) 
            VALUES ('Mifare DESFire EV2', 'MDF2', '')");
        $pdo->exec("INSERT INTO Technology (TechnologyName, TechnologyCode, TechnologyCardTypeID) 
            VALUES ('Mifare DESFire EV3', 'MDF3', '')");
        $pdo->exec("INSERT INTO Technology (TechnologyName, TechnologyCode, TechnologyCardTypeID) 
            VALUES ('Mifare DESFire Light', 'MDFL', '')");
        $pdo->exec("INSERT INTO Technology (TechnologyName, TechnologyCode, TechnologyCardTypeID) 
            VALUES ('Mifare Plus S', 'MPLS', '')");
        $pdo->exec("INSERT INTO Technology (TechnologyName, TechnologyCode, TechnologyCardTypeID) 
            VALUES ('Mifare Plus X', 'MPLX', '')");
        $pdo->exec("INSERT INTO Technology (TechnologyName, TechnologyCode, TechnologyCardTypeID) 
            VALUES ('Mifare UltraLight', 'MUL_', '')");
        $pdo->exec("INSERT INTO Technology (TechnologyName, TechnologyCode, TechnologyCardTypeID) 
            VALUES ('Mifare UltraLight C', 'MULC', '')");
        $pdo->exec("INSERT INTO Technology (TechnologyName, TechnologyCode, TechnologyCardTypeID) 
            VALUES ('NEDAP', 'NEDP', '')");
        $pdo->exec("INSERT INTO Technology (TechnologyName, TechnologyCode, TechnologyCardTypeID) 
            VALUES ('NeoCardPROX', 'NCPX', '')");
        $pdo->exec("INSERT INTO Technology (TechnologyName, TechnologyCode, TechnologyCardTypeID) 
            VALUES ('Nexwatch', 'NXWT', '')");
        $pdo->exec("INSERT INTO Technology (TechnologyName, TechnologyCode, TechnologyCardTypeID) 
            VALUES ('None', 'NONE', '')");
        $pdo->exec("INSERT INTO Technology (TechnologyName, TechnologyCode, TechnologyCardTypeID) 
            VALUES ('Ntag', 'NTAG', '')");
        $pdo->exec("INSERT INTO Technology (TechnologyName, TechnologyCode, TechnologyCardTypeID) 
            VALUES ('Pac/Stanley', 'PSTA', '')");
        $pdo->exec("INSERT INTO Technology (TechnologyName, TechnologyCode, TechnologyCardTypeID) 
            VALUES ('Paradox', 'PDOX', '')");
        $pdo->exec("INSERT INTO Technology (TechnologyName, TechnologyCode, TechnologyCardTypeID) 
            VALUES ('Pyramid', 'PYRM', '')");
        $pdo->exec("INSERT INTO Technology (TechnologyName, TechnologyCode, TechnologyCardTypeID) 
            VALUES ('Secura Key -01 RKCx-01', 'SK01', '')");
        $pdo->exec("INSERT INTO Technology (TechnologyName, TechnologyCode, TechnologyCardTypeID) 
            VALUES ('Secura Key -02 RKCx-02 / Radio', 'SK02', '')");
        $pdo->exec("INSERT INTO Technology (TechnologyName, TechnologyCode, TechnologyCardTypeID) 
            VALUES ('Topaz', 'TOPZ', '')");
        $pdo->exec("INSERT INTO Technology (TechnologyName, TechnologyCode, TechnologyCardTypeID) 
            VALUES ('ISO14443B SRx', 'I43S', '')");
        $pdo->exec("INSERT INTO Technology (TechnologyName, TechnologyCode, TechnologyCardTypeID) 
            VALUES ('Urmet', 'URMT', '')");
        $pdo->exec("INSERT INTO MediumType (MediumTypeName, MediumTypeDescription, MediumTypeCode) 
            VALUES ('FOB', 'Default 50mm x 30mm x 9mm OR 30mm disc','FOB_')");
        $pdo->exec("INSERT INTO MediumType (MediumTypeName, MediumTypeDescription, MediumTypeCode) 
            VALUES ('Mobile Phone', '','MOBP')");
        $pdo->exec("INSERT INTO MediumType (MediumTypeName, MediumTypeDescription, MediumTypeCode) 
            VALUES ('Other', '','OTHR')");
        $pdo->exec("INSERT INTO MediumType (MediumTypeName, MediumTypeDescription, MediumTypeCode) 
            VALUES ('Paper Ticket Tag', '','TICK')");
        $pdo->exec("INSERT INTO MediumType (MediumTypeName, MediumTypeDescription, MediumTypeCode) 
            VALUES ('Sticker Tag', '','STTG')");
        $pdo->exec("INSERT INTO MediumType (MediumTypeName, MediumTypeDescription, MediumTypeCode) 
            VALUES ('Thick Card', 'Clamshell 85.6-86mm x 53.98-54mm x 1.8mm','CLAM')");
        $pdo->exec("INSERT INTO MediumType (MediumTypeName, MediumTypeDescription, MediumTypeCode) 
            VALUES ('Thin Card', 'ISO/IEC 7810 85.6mm x 54mm x 0.76mm','THIN')");
        $pdo->exec("INSERT INTO MediumType (MediumTypeName, MediumTypeDescription, MediumTypeCode) 
            VALUES ('Tube', '','TUBE')");
        /*
        $pdo->exec("INSERT INTO Media (
            MediaIndex,
            MediumType,
            PrimarySample,
            CISCode,
            Printed1,
            Printed2,
            Printed3,
            Printed4,
            Printed5, 
            Printed6, 
            Printed7, 
            Brand, 
            Color, 
            Sample1, 
            Sample2, 
            Sample3, 
            Sample4) VALUES (
            1, 
            'Thin Card', 
            1, 
            '01-15',
            '808659546', 
            'www.cardtech.no', 
            '50010/M2750', 
            'HF01.01', 
            '', 
            '', 
            '', 
            '',
            '', 
            1, 
            NULL, 
            NULL, 
            NULL
        )");
*/

    } catch (\PDOException $e) {
    // If connection fails, stop the script and show the error
    die("Database connection failed: " . $e->getMessage());
}
?>