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
    faqitem INTEGER REFERENCES FAQITEM(id),
    department VARCHAR REFERENCES DEPARTMENT(name) ON DELETE SET NULL,
    aID INTEGER REFERENCES CLIENT(uid),
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
    uID INTEGER REFERENCES CLIENT(uid) NOT NULL,
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
    aID INTEGER REFERENCES CLIENT(uid),
    department VARCHAR REFERENCES DEPARTMENT(name) ON DELETE CASCADE,
    PRIMARY KEY(aID, department) 
);

CREATE TABLE TICKETTAG (
    tID INTEGER REFERENCES TICKET(id) ON DELETE CASCADE,
    tag VARCHAR REFERENCES TAG(name),
    PRIMARY KEY(tID, tag)
);

CREATE TABLE FAQTAG (
    fID INTEGER REFERENCES FAQITEM(id),
    tag VARCHAR REFERENCES TAG(name),
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
VALUES (25, 'onso', '$2y$10$elfuu1AexoMbccFQaG28Pu9GdtfHhH2bGfchrSVOn6OiYWg6.Pw/y', 'afonso.vo@gmail.com', 2);

-- Inserting data into DEPARTMENT table
INSERT INTO DEPARTMENT (name) VALUES ('Vendas'), ('Suporte'), ('Financeiro');

-- Inserting data into TAG table
/*INSERT INTO TAG (name) VALUES ('potato'), ('tomato'), ('banana'), ('apple');*/

-- Inserting data into STATUS table
INSERT INTO STATUS (name) VALUES ('open'), ('assigned'), ('closed');

-- Inserting data into TICKET table
INSERT INTO TICKET (id, title, text, dateCreated, priority, status, faqitem, department, aID, uID, history, future)
VALUES (1, 'Urgent Issue', 'Having trouble accessing the system', '2023-05-12', 1, 'open', NULL, 'Suporte', NULL, 25, NULL, NULL),
       (2, 'Payment Inquiry', 'Need information about my recent payment', '2023-05-13', 2, 'open', NULL, 'Financeiro', NULL, 25, NULL, NULL),
       (3, 'Product Recommendation', 'Looking for suggestions on new products', '2023-05-14', 1, 'assigned', NULL, 'Vendas', NULL, 25, NULL, NULL);

-- Inserting data into FAQITEM table
INSERT INTO FAQITEM (id, question, answer, dateCreated)
VALUES (1, 'How do I reset my password?', 'You can reset your password by clicking on the "Forgot Password" link on the login page.', '2023-05-10'),
       (2, 'What payment methods do you accept?', 'We accept credit cards (Visa, MasterCard, and American Express) and PayPal.', '2023-05-11'),
       (3, 'How can I track my order?', 'Once your order is shipped, you will receive a tracking number via email.', '2023-05-12');

-- Inserting data into MESSAGE table
INSERT INTO MESSAGE (id, text, dateSent, uID, tID)
VALUES (1, 'I''m unable to login. Help!', '2023-05-12', 25, 1),
       (2, 'Can you provide a refund?', '2023-05-13', 25, 2),
       (3, 'I need assistance with my order', '2023-05-14', 25, 3);

INSERT INTO AGENTDEPARTMENT VALUES (25, 'Vendas'), (25, 'Financeiro');