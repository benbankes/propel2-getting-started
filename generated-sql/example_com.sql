
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- job
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `job`;

CREATE TABLE `job`
(
    `jnum` CHAR(5) NOT NULL,
    `jname` CHAR(20) NOT NULL,
    `city` CHAR(15) NOT NULL,
    PRIMARY KEY (`jnum`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- product
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `product`;

CREATE TABLE `product`
(
    `pnum` CHAR(6) NOT NULL,
    `name` CHAR(20) NOT NULL,
    `color` CHAR(6) NOT NULL,
    `weight` DECIMAL(5,1) NOT NULL,
    `city` CHAR(15) NOT NULL,
    PRIMARY KEY (`pnum`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- supplier
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `supplier`;

CREATE TABLE `supplier`
(
    `snum` CHAR(5) NOT NULL,
    `name` CHAR(20) NOT NULL,
    `status` INTEGER NOT NULL,
    `city` CHAR(15) NOT NULL,
    PRIMARY KEY (`snum`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- supplier_product
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `supplier_product`;

CREATE TABLE `supplier_product`
(
    `snum` CHAR(5) NOT NULL,
    `pnum` CHAR(6) NOT NULL,
    `qty` INTEGER NOT NULL,
    PRIMARY KEY (`snum`,`pnum`),
    INDEX `FK_supplier_product_product` (`pnum`),
    CONSTRAINT `FK_supplier_product_product`
        FOREIGN KEY (`pnum`)
        REFERENCES `product` (`pnum`),
    CONSTRAINT `FK_supplier_product_supplier`
        FOREIGN KEY (`snum`)
        REFERENCES `supplier` (`snum`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- supplier_product_job
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `supplier_product_job`;

CREATE TABLE `supplier_product_job`
(
    `snum` CHAR(5) NOT NULL,
    `pnum` CHAR(6) NOT NULL,
    `jnum` CHAR(5) NOT NULL,
    `qty` INTEGER NOT NULL,
    PRIMARY KEY (`snum`,`pnum`,`jnum`),
    INDEX `FK_supplier_product_job_product` (`pnum`),
    INDEX `FK_supplier_product_job_job` (`jnum`),
    CONSTRAINT `FK_supplier_product_job_job`
        FOREIGN KEY (`jnum`)
        REFERENCES `job` (`jnum`),
    CONSTRAINT `FK_supplier_product_job_product`
        FOREIGN KEY (`pnum`)
        REFERENCES `product` (`pnum`),
    CONSTRAINT `FK_supplier_product_job_supplier`
        FOREIGN KEY (`snum`)
        REFERENCES `supplier` (`snum`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
