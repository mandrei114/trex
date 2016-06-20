CREATE TABLE BUDGET (
    ID_BUDGET int NOT NULL,
    BUDGET_YEAR int NOT NULL,
    BUDGET_MONTH int NOT NULL,
    BUDGET_WEEK int NOT NULL,
    AMOUNT double(10,2) NOT NULL,
    FK_USER int NOT NULL,
    CONSTRAINT BUDGET_pk PRIMARY KEY (ID_BUDGET)
);

-- Table: CATEGORY
CREATE TABLE CATEGORY (
    ID_CATEGORY int NOT NULL,
    CATEGORY_NAME varchar(100) NOT NULL,
    CATEGORY_DESCRIPTION varchar(200) NOT NULL,
    ID_PARENT int NULL,
    CONSTRAINT CATEGORY_pk PRIMARY KEY (ID_CATEGORY)
);

-- Table: EXPENSE
CREATE TABLE EXPENSE (
    ID_EXPENSE int NOT NULL,
    EXPENSE_DATE date NOT NULL,
    AMOUNT double(10,2) NOT NULL,
    FK_CATEGORY int NOT NULL,
    FK_USER int NOT NULL,
    CONSTRAINT EXPENSE_pk PRIMARY KEY (ID_EXPENSE)
);

-- Table: GROUP_CATEGORY
CREATE TABLE GROUP_CATEGORY (
    ID_GROUP_CATEGORY int NOT NULL,
    FK_USER_GROUP int NOT NULL,
    FK_CATEGORY int NOT NULL,
    CONSTRAINT GROUP_CATEGORY_pk PRIMARY KEY (ID_GROUP_CATEGORY)
);


-- Table: USER
CREATE TABLE USER (
    ID_USER int NOT NULL,
    EMAIL varchar(100) NOT NULL,
    PASSWORD varchar(100) NOT NULL,
    FIRST_NAME varchar(100) NOT NULL,
    LAST_NAME varchar(100) NOT NULL,
    SEX varchar(1) NOT NULL COMMENT 'M FOR MALE F FOR FEMALE',
    CONSTRAINT USER_pk PRIMARY KEY (ID_USER)
);

-- Table: USER_CATEGORY
CREATE TABLE USER_CATEGORY (
    ID_USER_CATEGORY int NOT NULL,
    FK_USER int NOT NULL,
    FK_CATEGORY int NOT NULL,
    CONSTRAINT USER_CATEGORY_pk PRIMARY KEY (ID_USER_CATEGORY)
);

-- Table: USER_GROUP
CREATE TABLE USER_GROUP (
    ID_USER_GROUP int NOT NULL,
    ID_USER int NOT NULL COMMENT 'THE ID OF THE USER WHICH IS THE ADMIN OF THE GROUP',
    CONSTRAINT USER_GROUP_pk PRIMARY KEY (ID_USER_GROUP)
);

-- Table: USER_GROUP_USER
CREATE TABLE USER_GROUP_USER (
    ID_GROUP_USER int NOT NULL,
    FK_USER int NOT NULL,
    FK_USER_GROUP int NOT NULL,
    CONSTRAINT USER_GROUP_USER_pk PRIMARY KEY (ID_GROUP_USER)
);

-- foreign keys
-- Reference: BUDGET_USER (table: BUDGET)
ALTER TABLE BUDGET ADD CONSTRAINT BUDGET_USER FOREIGN KEY BUDGET_USER (FK_USER)
    REFERENCES USER (ID_USER);

-- Reference: CATEGORY_CATEGORY (table: CATEGORY)
ALTER TABLE CATEGORY ADD CONSTRAINT CATEGORY_CATEGORY FOREIGN KEY CATEGORY_CATEGORY (ID_PARENT)
    REFERENCES CATEGORY (ID_CATEGORY);

-- Reference: EXPENSE_CATEGORY (table: EXPENSE)
ALTER TABLE EXPENSE ADD CONSTRAINT EXPENSE_CATEGORY FOREIGN KEY EXPENSE_CATEGORY (FK_CATEGORY)
    REFERENCES CATEGORY (ID_CATEGORY);

-- Reference: EXPENSE_USER (table: EXPENSE)
ALTER TABLE EXPENSE ADD CONSTRAINT EXPENSE_USER FOREIGN KEY EXPENSE_USER (FK_USER)
    REFERENCES USER (ID_USER);

-- Reference: GROUP_CATEGORY_CATEGORY (table: GROUP_CATEGORY)
ALTER TABLE GROUP_CATEGORY ADD CONSTRAINT GROUP_CATEGORY_CATEGORY FOREIGN KEY GROUP_CATEGORY_CATEGORY (FK_CATEGORY)
    REFERENCES CATEGORY (ID_CATEGORY);

-- Reference: GROUP_CATEGORY_USER_GROUP (table: GROUP_CATEGORY)
ALTER TABLE GROUP_CATEGORY ADD CONSTRAINT GROUP_CATEGORY_USER_GROUP FOREIGN KEY GROUP_CATEGORY_USER_GROUP (FK_USER_GROUP)
    REFERENCES USER_GROUP (ID_USER_GROUP);

-- Reference: USER_CATEGORY_CATEGORY (table: USER_CATEGORY)
ALTER TABLE USER_CATEGORY ADD CONSTRAINT USER_CATEGORY_CATEGORY FOREIGN KEY USER_CATEGORY_CATEGORY (FK_CATEGORY)
    REFERENCES CATEGORY (ID_CATEGORY);

-- Reference: USER_CATEGORY_USER (table: USER_CATEGORY)
ALTER TABLE USER_CATEGORY ADD CONSTRAINT USER_CATEGORY_USER FOREIGN KEY USER_CATEGORY_USER (FK_USER)
    REFERENCES USER (ID_USER);

-- Reference: USER_GROUP_USER (table: USER_GROUP)
ALTER TABLE USER_GROUP ADD CONSTRAINT USER_GROUP_USER FOREIGN KEY USER_GROUP_USER (ID_USER)
    REFERENCES USER (ID_USER);

-- Reference: USER_GROUP_USER_USER (table: USER_GROUP_USER)
ALTER TABLE USER_GROUP_USER ADD CONSTRAINT USER_GROUP_USER_USER FOREIGN KEY USER_GROUP_USER_USER (FK_USER)
    REFERENCES USER (ID_USER);

-- Reference: USER_GROUP_USER_USER_GROUP (table: USER_GROUP_USER)
ALTER TABLE USER_GROUP_USER ADD CONSTRAINT USER_GROUP_USER_USER_GROUP FOREIGN KEY USER_GROUP_USER_USER_GROUP (FK_USER_GROUP)
    REFERENCES USER_GROUP (ID_USER_GROUP);


