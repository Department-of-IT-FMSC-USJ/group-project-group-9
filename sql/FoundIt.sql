create database founditdb;
CREATE TABLE admin_data_info (
    admin_id INT(11) NOT NULL AUTO_INCREMENT,
    Name VARCHAR(255) NOT NULL,
    username VARCHAR(100) NOT NULL UNIQUE,
    Email VARCHAR(255) NOT NULL UNIQUE,
    telephone_num VARCHAR(20),
    Password VARCHAR(255) NOT NULL,
    PRIMARY KEY (admin_id)
);

CREATE TABLE item (
    Item_ID INT(11) NOT NULL AUTO_INCREMENT,
    Item_Name VARCHAR(255) NOT NULL,
    Category VARCHAR(100) NOT NULL,
    Item_Description TEXT,
    Item_Location VARCHAR(255),
    Date_Lost DATE,
    Item_Image VARCHAR(255),
    Bounty DECIMAL(10,2) DEFAULT 0.00,
    Created_At TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (Item_ID)
);

CREATE TABLE found_item (
    Item_ID INT(11) NOT NULL PRIMARY KEY,
    Item_Name VARCHAR(100) NOT NULL,
    Category VARCHAR(100),
    Item_Description TEXT,
    Item_Location VARCHAR(150),
    Date_Lost DATE,
    Item_Image VARCHAR(255),
    Bounty DECIMAL(10,2)
);

CREATE TABLE approved_items (
    Item_ID INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    Item_Name VARCHAR(255) NOT NULL,
    Category VARCHAR(100) NOT NULL,
    Item_Description TEXT,
    Item_Location VARCHAR(255),
    Date_Lost DATE,
    Item_Image VARCHAR(255),
    Bounty DECIMAL(10,2)
);

CREATE TABLE item_found (
    Lost_Item_ID INT(11) NOT NULL PRIMARY KEY,
    Your_Name VARCHAR(100) NOT NULL,
    Contact_Number VARCHAR(15) NOT NULL,
    Location_Found VARCHAR(255) NOT NULL,
    Date_Found DATE NOT NULL,
    Bank_Account_No VARCHAR(50) NOT NULL,
    Uploaded_Image VARCHAR(255)
);

CREATE TABLE personal_details (
    Item_Id INT(11),
    NIC VARCHAR(20),
    Name VARCHAR(100) NOT NULL,
    Tel_No VARCHAR(16) NOT NULL
);



