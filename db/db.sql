-- DB
DROP DATABASE IF EXISTS OnlineStore;
CREATE DATABASE OnlineStore;
USE OnlineStore;

-- Tables
CREATE TABLE Gender(
    GENDERID BIGINT NOT NULL AUTO_INCREMENT,
    GenderName VARCHAR(255) NOT NULL,
    PRIMARY KEY(GENDERID)
);

CREATE TABLE pImage(
    IMAGEID BIGINT NOT NULL AUTO_INCREMENT,
    ImageName VARCHAR(255) NOT NULL,
    PRIMARY KEY(IMAGEID)
);

CREATE TABLE pSize(
    SIZEID BIGINT NOT NULL AUTO_INCREMENT,
    Size DECIMAL(3,1) NOT NULL,
    PRIMARY KEY(SIZEID)
);

CREATE TABLE Brand(
    BRANDID BIGINT NOT NULL AUTO_INCREMENT,
    BrandName VARCHAR(255) NOT NULL,
    PRIMARY KEY(BRANDID)
);

CREATE TABLE Color(
    COLORID     BIGINT NOT NULL AUTO_INCREMENT,
    ColorName   VARCHAR(255) NOT NULL,
    Hex         BINARY(3) NOT NULL,
    PRIMARY KEY (COLORID)
);

CREATE TABLE pType(
    TYPEID BIGINT NOT NULL AUTO_INCREMENT,
    TypeName VARCHAR(255) NOT NULL,

    PRIMARY KEY(TYPEID)
);

CREATE TABLE Product(
    PRODUCTID BIGINT NOT NULL AUTO_INCREMENT,
    ProductName VARCHAR(255) NOT NULL,
    ProductDescription TEXT,
    Price DECIMAL(12,2) NOT NULL,
    Listed BOOLEAN NOT NULL,
    DateCreated TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,

    BRANDID BIGINT NOT NULL,
    TYPEID BIGINT NOT NULL,

    PRIMARY KEY(PRODUCTID),
    FOREIGN KEY (BRANDID) REFERENCES Brand(BRANDID),
    FOREIGN KEY (TYPEID) REFERENCES pType(TYPEID)
);

CREATE TABLE User(
    USERID BIGINT NOT NULL AUTO_INCREMENT,
    LastName VARCHAR(255) NOT NULL,
    FirstName VARCHAR(255) NOT NULL,
    Email VARCHAR(255) NOT NULL,
    Password VARCHAR(255) NOT NULL,
    BirthDate DATE NOT NULL,
    LastLogin TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    DateCreated TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,

    GENDERID BIGINT NOT NULL,

    PRIMARY KEY(USERID),
    FOREIGN KEY (GENDERID) REFERENCES Gender(GENDERID)
);


CREATE TABLE Wishlist(
    WISHLISTID BIGINT NOT NULL AUTO_INCREMENT,
    DateAdded TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    
    PRODUCTID BIGINT NOT NULL,
    USERID BIGINT NOT NULL,

    PRIMARY KEY(WISHLISTID),
    FOREIGN KEY (PRODUCTID) REFERENCES Product(PRODUCTID),
    FOREIGN KEY (USERID) REFERENCES User(USERID)
);

CREATE TABLE Cart(
    CARTID BIGINT NOT NULL AUTO_INCREMENT,
    DateAdded TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,

    PRODUCTID BIGINT NOT NULL,
    USERID BIGINT NOT NULL,

    PRIMARY KEY(CARTID),
    FOREIGN KEY (PRODUCTID) REFERENCES Product(PRODUCTID),
    FOREIGN KEY (USERID) REFERENCES User(USERID)
);

CREATE TABLE pImage_Product(
    IMAGEID BIGINT NOT NULL,
    PRODUCTID BIGINT NOT NULL,

    PRIMARY KEY(IMAGEID, PRODUCTID),
    FOREIGN KEY (IMAGEID) REFERENCES pImage(IMAGEID),
    FOREIGN KEY (PRODUCTID) REFERENCES Product(PRODUCTID)
);

CREATE TABLE Color_Product(
    COLORID BIGINT NOT NULL,
    PRODUCTID BIGINT NOT NULL,

    PRIMARY KEY (COLORID, PRODUCTID),
    FOREIGN KEY (COLORID) REFERENCES Color(COLORID),
    FOREIGN KEY (PRODUCTID) REFERENCES Product(PRODUCTID)
);

CREATE TABLE pSize_Product(
    SIZEID BIGINT NOT NULL,
    PRODUCTID BIGINT NOT NULL,

    PRIMARY KEY (SIZEID, PRODUCTID),
    FOREIGN KEY (SIZEID) REFERENCES pSize(SIZEID),
    FOREIGN KEY (PRODUCTID) REFERENCES Product(PRODUCTID)
);

-- Index
CREATE UNIQUE INDEX UK_Email
ON User (Email);

CREATE UNIQUE INDEX UK_GenderName
ON Gender (GenderName);

CREATE UNIQUE INDEX UK_ImageName
ON pImage (ImageName);

CREATE UNIQUE INDEX UK_BrandName
ON Brand (BrandName);

CREATE UNIQUE INDEX UK_ColorHex
ON Color (Hex);

CREATE UNIQUE INDEX UK_ProductTypeName
ON pType (TypeName);

CREATE UNIQUE INDEX UK_pSize
ON pSize (Size);




CREATE INDEX FK_Product
ON Product (BRANDID);

CREATE INDEX FK_User
ON User (GENDERID);

CREATE INDEX FK_Wishlist
ON Wishlist (PRODUCTID, USERID);

CREATE INDEX FK_Cart
ON Cart (PRODUCTID, USERID);

CREATE INDEX FK_pImage_Product
ON pImage_Product (IMAGEID, PRODUCTID);

CREATE INDEX FK_Color_Product
ON Color_Product (PRODUCTID, COLORID);

CREATE INDEX FK_pSize_Product
ON pSize_Product (PRODUCTID, SIZEID);