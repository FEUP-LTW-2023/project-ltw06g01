PRAGMA foreign_keys = ON;

CREATE TABLE TAG (
    name VARCHAR PRIMARY KEY
);

CREATE TABLE STATUS (
    name VARCHAR PRIMARY KEY
);

CREATE TABLE TICKET (
    id INTEGER PRIMARY KEY,
    title VARCHAR NOT NULL,
    text VARCHAR NOT NULL,
    dateCreated DATETIME NOT NULL,
    priority INTEGER,
    status VARCHAR REFERENCES STATUS(name) ON DELETE SET DEFAULT DEFAULT "open",
    faqitem INTEGER REFERENCES FAQITEM(id) ON DELETE SET NULL,
    department VARCHAR REFERENCES DEPARTMENT(name) ON DELETE SET NULL,
    aID INTEGER REFERENCES CLIENT(uid) ON DELETE SET NULL,
    uID INTEGER REFERENCES CLIENT(uid) NOT NULL,
    history INTEGER REFERENCES TICKET(id),
    future INTEGER REFERENCES TICKET(id) ON DELETE CASCADE,
    /*CHECK(isHistory >= 0),*/
    CHECK(priority >= 0)
);

CREATE TABLE FAQITEM (
    id INTEGER PRIMARY KEY,
    question VARCHAR NOT NULL,
    answer VARCHAR NOT NULL,
    dateCreated DATETIME NOT NULL
);

CREATE TABLE MESSAGE (
    id INTEGER PRIMARY KEY,
    text VARCHAR NOT NULL,
    dateSent DATETIME NOT NULL,
    uID INTEGER REFERENCES CLIENT(uid) ON DELETE CASCADE NOT NULL,
    tID INTEGER REFERENCES TICKET(id) ON DELETE CASCADE NOT NULL
);

CREATE TABLE CLIENT (
    uid INTEGER PRIMARY KEY,
    username VARCHAR NOT NULL UNIQUE,
    passHash VARCHAR NOT NULL,
    email VARCHAR NOT NULL UNIQUE,
    permissionLevel INTEGER NOT NULL,
    CHECK(permissionLevel >= 0 AND permissionLevel < 3)
);

CREATE TABLE DEPARTMENT (
    name VARCHAR PRIMARY KEY
);

/*CREATE TABLE AGENT (
    uid INTEGER PRIMARY KEY,
    username VARCHAR NOT NULL,
    passHash VARCHAR NOT NULL,
    email VARCHAR NOT NULL,
    isAdmin BOOLEAN NOT NULL
);*/

CREATE TABLE AGENTDEPARTMENT (
    aID INTEGER REFERENCES CLIENT(uid) ON DELETE CASCADE,
    department VARCHAR REFERENCES DEPARTMENT(name) ON DELETE CASCADE,
    PRIMARY KEY(aID, department) 
);

CREATE TABLE TICKETTAG (
    tID INTEGER REFERENCES TICKET(id) ON DELETE CASCADE,
    tag VARCHAR REFERENCES TAG(name) ON DELETE CASCADE,
    PRIMARY KEY(tID, tag)
);

CREATE TABLE FAQTAG (
    fID INTEGER REFERENCES FAQITEM(id) ON DELETE CASCADE,
    tag VARCHAR REFERENCES TAG(name) ON DELETE CASCADE,
    PRIMARY KEY (fID, tag)
);

CREATE TRIGGER tag_insert
    BEFORE INSERT ON TICKETTAG
    WHEN NOT EXISTS (SELECT * FROM TAG WHERE name = NEW.tag)
    BEGIN
        INSERT INTO TAG (name) VALUES (NEW.tag);
    END; 

CREATE TRIGGER tag_delete
    AFTER DELETE ON TICKETTAG
    WHEN NOT EXISTS (SELECT * FROM TICKETTAG WHERE tag = OLD.tag)
    BEGIN
        DELETE FROM TAG WHERE name = OLD.tag;
    END;        

-- Inserting data into CLIENT table
INSERT INTO CLIENT (uid, username, passHash, email, permissionLevel)
VALUES (25, 'onso', '$2y$10$elfuu1AexoMbccFQaG28Pu9GdtfHhH2bGfchrSVOn6OiYWg6.Pw/y', 'afonso.vo@gmail.com', 2),
    (29, 'user1', '$2y$10$psyXmW4voZKaaOGsDwoJLOlVXb74SZGcVOscc.9hJI2iqzSV5BsAS', 'user1@example.com', 2),
    (30, 'user2', '$2y$10$psyXmW4voZKaaOGsDwoJLOlVXb74SZGcVOscc.9hJI2iqzSV5BsAS', 'user2@example.com', 1),
    (31, 'user3', '$2y$10$psyXmW4voZKaaOGsDwoJLOlVXb74SZGcVOscc.9hJI2iqzSV5BsAS', 'user3@example.com', 0),
    (32, 'user4', '$2y$10$psyXmW4voZKaaOGsDwoJLOlVXb74SZGcVOscc.9hJI2iqzSV5BsAS', 'user4@example.com', 2),
    (33, 'user5', '$2y$10$psyXmW4voZKaaOGsDwoJLOlVXb74SZGcVOscc.9hJI2iqzSV5BsAS', 'user5@example.com', 1),
    (34, 'user6', '$2y$10$psyXmW4voZKaaOGsDwoJLOlVXb74SZGcVOscc.9hJI2iqzSV5BsAS', 'user6@example.com', 0),
    (35, 'user7', '$2y$10$psyXmW4voZKaaOGsDwoJLOlVXb74SZGcVOscc.9hJI2iqzSV5BsAS', 'user7@example.com', 2),
    (36, 'user8', '$2y$10$psyXmW4voZKaaOGsDwoJLOlVXb74SZGcVOscc.9hJI2iqzSV5BsAS', 'user8@example.com', 1),
    (37, 'user9', '$2y$10$psyXmW4voZKaaOGsDwoJLOlVXb74SZGcVOscc.9hJI2iqzSV5BsAS', 'user9@example.com', 0);


-- Inserting data into DEPARTMENT table
INSERT INTO DEPARTMENT (name) VALUES ('Sales'), ('Support'), ('Finances'), ('Human Resources'), ('Operations'),('Research and Development'), ('Customer Service');

-- Inserting data into TAG table
/*INSERT INTO TAG (name) VALUES ('potato'), ('tomato'), ('banana'), ('apple');*/

-- Inserting data into STATUS table
INSERT INTO STATUS (name) VALUES ('open'), ('assigned'), ('closed');

-- Inserting data into TICKET table
INSERT INTO TICKET (id, title, text, dateCreated, priority, status, faqitem, department, aID, uID, history, future)
VALUES (1, 'Urgent Issue', 'Having trouble accessing the system', '2023-05-12', 1, 'open', NULL, 'Support', NULL, 25, NULL, NULL),
       (2, 'Payment Inquiry', 'Need information about my recent payment', '2023-05-13', 2, 'open', NULL, 'Finances', NULL, 25, NULL, NULL),
       (3, 'Product Recommendation', 'Looking for suggestions on new products', '2023-05-14', 1, 'assigned', NULL, 'Sales', NULL, 25, NULL, NULL);

-- Inserting data into FAQITEM table
INSERT INTO FAQITEM (id, question, answer, dateCreated)
VALUES (1, 'How do I reset my password?', 'You can reset your password by clicking on the "Forgot Password" link on the login page.', '2023-05-10'),
       (2, 'What payment methods do you accept?', 'We accept credit cards (Visa, MasterCard, and American Express) and PayPal.', '2023-05-11'),
       (3, 'How can I track my order?', 'Once your order is shipped, you will receive a tracking number via email.', '2023-05-12'),
       (4, 'Can I cancel my order?', 'Yes, you can cancel your order before it has been shipped. Please contact our customer support for assistance.', '2023-05-13'),
       (5, 'What is your return policy?', 'We have a 30-day return policy. If you are not satisfied with your purchase, you can return it within 30 days for a full refund.', '2023-05-14'),
       (6, 'How long does shipping take?', 'Shipping times vary depending on your location. Typically, it takes 3-5 business days for domestic orders and 7-14 business days for international orders.', '2023-05-15'),
        (7, 'What is your shipping cost?', 'Shipping costs vary depending on the weight and destination of your order. You can view the shipping cost during the checkout process.', '2023-05-16'),
       (8, 'How can I contact customer support?', 'You can contact our customer support team by emailing support@example.com or by calling our toll-free number: 1-800-123-4567.', '2023-05-17'),
       (9, 'Do you offer international shipping?', 'Yes, we offer international shipping to most countries. Shipping times and costs may vary for international orders.', '2023-05-18'),
       (10, 'Can I change my order after it has been placed?', 'Unfortunately, we cannot guarantee changes to an order once it has been placed. Please contact our customer support for assistance.', '2023-05-19');


-- Inserting data into MESSAGE table
INSERT INTO MESSAGE (id, text, dateSent, uID, tID)
VALUES (1, 'I''m unable to login. Help!', '2023-05-12', 25, 1),
       (2, 'Can you provide a refund?', '2023-05-13', 25, 2),
       (3, 'I need assistance with my order', '2023-05-14', 25, 3);

INSERT INTO AGENTDEPARTMENT VALUES (25, 'Sales'), (25, 'Finances');