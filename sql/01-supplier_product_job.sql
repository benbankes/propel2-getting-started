-- Taken from https://github.com/vrajmohan/pgsql-sample-data/blob/master/date_spj.sql

-- This is the Suppliers-Parts-Projects example from C. J. Date, "An Introduction to Database Systems", 7th Edition.
-- The schema and data have been reproduced exactly, with the only difference being that invalid names 
-- like s#, p#,... have been replaced by snum, pnum,....

DROP TABLE IF EXISTS supplier_product_job;
DROP TABLE IF EXISTS supplier_product;
DROP TABLE IF EXISTS supplier;
DROP TABLE IF EXISTS product;
DROP TABLE IF EXISTS job;

CREATE TABLE supplier
(
	snum CHAR(5) NOT NULL,
	name CHAR(20) NOT NULL,
	status INTEGER NOT NULL,
	city CHAR(15) NOT NULL,
	PRIMARY KEY (snum)
);

CREATE TABLE product
(
	pnum CHAR(6) NOT NULL,
	name CHAR(20) NOT NULL,
	color CHAR(6) NOT NULL,
	weight NUMERIC(5,1) NOT NULL,
	city CHAR(15) NOT NULL,
	PRIMARY KEY (pnum)
);

CREATE TABLE supplier_product
(
	snum CHAR(5) NOT NULL,
	pnum CHAR(6) NOT NULL,
	qty INTEGER NOT NULL,
	PRIMARY KEY (snum, pnum),
	CONSTRAINT FK_supplier_product_supplier
		FOREIGN KEY (snum)
		REFERENCES supplier (snum),
	CONSTRAINT FK_supplier_product_product
		FOREIGN KEY (pnum)
		REFERENCES product (pnum)
);

INSERT INTO supplier VALUES ('S1', 'Smith', 20, 'London');
INSERT INTO supplier VALUES ('S2', 'Jones', 10, 'Paris');
INSERT INTO supplier VALUES ('S3', 'Blake', 30, 'Paris');
INSERT INTO supplier VALUES ('S4', 'Clark', 20, 'London');
INSERT INTO supplier VALUES ('S5', 'Adams', 30, 'Athens');

INSERT INTO product VALUES ('P1', 'Nut', 'Red', 12, 'London');
INSERT INTO product VALUES ('P2', 'Bolt', 'Green', 17, 'Paris');
INSERT INTO product VALUES ('P3', 'Screw', 'Blue', 17, 'Oslo');
INSERT INTO product VALUES ('P4', 'Screw', 'Red', 14, 'London');
INSERT INTO product VALUES ('P5', 'Cam', 'Blue', 12, 'Paris');
INSERT INTO product VALUES ('P6', 'Cog', 'Red', 19, 'London');

INSERT INTO supplier_product VALUES ('S1', 'P1', 300);
INSERT INTO supplier_product VALUES ('S1', 'P2', 200);
INSERT INTO supplier_product VALUES ('S1', 'P3', 400);
INSERT INTO supplier_product VALUES ('S1', 'P4', 200);
INSERT INTO supplier_product VALUES ('S1', 'P5', 100);
INSERT INTO supplier_product VALUES ('S1', 'P6', 100);
INSERT INTO supplier_product VALUES ('S2', 'P1', 300);
INSERT INTO supplier_product VALUES ('S2', 'P2', 400);
INSERT INTO supplier_product VALUES ('S3', 'P2', 200);
INSERT INTO supplier_product VALUES ('S4', 'P2', 200);
INSERT INTO supplier_product VALUES ('S4', 'P4', 300);
INSERT INTO supplier_product VALUES ('S4', 'P5', 400);

CREATE TABLE job
(
	jnum CHAR(5) NOT NULL,
	jname CHAR(20) NOT NULL,
	city CHAR(15) NOT NULL,
	PRIMARY KEY (jnum)
);

CREATE TABLE supplier_product_job
(
	snum CHAR(5) REFERENCES supplier,
	pnum CHAR(6) REFERENCES part,
	jnum CHAR(5) REFERENCES job,
	qty INTEGER NOT NULL,
	PRIMARY KEY (snum, pnum, jnum),
	CONSTRAINT FK_supplier_product_job_supplier
		FOREIGN KEY (snum)
		REFERENCES supplier (snum),
	CONSTRAINT FK_supplier_product_job_product
		FOREIGN KEY (pnum)
		REFERENCES product (pnum),
	CONSTRAINT FK_supplier_product_job_job
		FOREIGN KEY (jnum)
		REFERENCES job (jnum)
);

INSERT INTO job VALUES('J1', 'Sorter', 'Paris');
INSERT INTO job VALUES('J2', 'Display', 'Rome');
INSERT INTO job VALUES('J3', 'OCR', 'Athens');
INSERT INTO job VALUES('J4', 'Console', 'Athens');
INSERT INTO job VALUES('J5', 'RAID', 'London');
INSERT INTO job VALUES('J6', 'EDS', 'Oslo');
INSERT INTO job VALUES('J7', 'Tape', 'London');

INSERT INTO supplier_product_job VALUES ('S1', 'P1', 'J1', 200);
INSERT INTO supplier_product_job VALUES ('S1', 'P1', 'J4', 700);
INSERT INTO supplier_product_job VALUES ('S2', 'P3', 'J1', 400);
INSERT INTO supplier_product_job VALUES ('S2', 'P3', 'J2', 200);
INSERT INTO supplier_product_job VALUES ('S2', 'P3', 'J3', 200);
INSERT INTO supplier_product_job VALUES ('S2', 'P3', 'J4', 500);
INSERT INTO supplier_product_job VALUES ('S2', 'P3', 'J5', 600);
INSERT INTO supplier_product_job VALUES ('S2', 'P3', 'J6', 400);
INSERT INTO supplier_product_job VALUES ('S2', 'P3', 'J7', 800);
INSERT INTO supplier_product_job VALUES ('S2', 'P5', 'J2', 100);
INSERT INTO supplier_product_job VALUES ('S3', 'P3', 'J1', 200);
INSERT INTO supplier_product_job VALUES ('S3', 'P4', 'J2', 500);
INSERT INTO supplier_product_job VALUES ('S4', 'P6', 'J3', 300);
INSERT INTO supplier_product_job VALUES ('S4', 'P6', 'J7', 300);
INSERT INTO supplier_product_job VALUES ('S5', 'P2', 'J2', 200);
INSERT INTO supplier_product_job VALUES ('S5', 'P2', 'J4', 100);
INSERT INTO supplier_product_job VALUES ('S5', 'P5', 'J5', 500);
INSERT INTO supplier_product_job VALUES ('S5', 'P5', 'J7', 100);
INSERT INTO supplier_product_job VALUES ('S5', 'P6', 'J2', 200);
INSERT INTO supplier_product_job VALUES ('S5', 'P1', 'J4', 100);
INSERT INTO supplier_product_job VALUES ('S5', 'P3', 'J4', 200);
INSERT INTO supplier_product_job VALUES ('S5', 'P4', 'J4', 800);
INSERT INTO supplier_product_job VALUES ('S5', 'P5', 'J4', 400);
INSERT INTO supplier_product_job VALUES ('S5', 'P6', 'J4', 500);
