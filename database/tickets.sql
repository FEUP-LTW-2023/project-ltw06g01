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
    status VARCHAR REFERENCES STATUS(name),
    faqitem INTEGER REFERENCES FAQITEM(id),
    department VARCHAR REFERENCES DEPARTMENT(name),
    aID INTEGER REFERENCES CLIENT(uid),
    uID INTEGER REFERENCES CLIENT(uid) NOT NULL,
    history INTEGER REFERENCES TICKET(id),
    future INTEGER REFERENCES TICKET(id),
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
    uID INTEGER REFERENCES CLIENT(id) NOT NULL,
    tID INTEGER REFERENCES TICKET(id) NOT NULL
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
    department VARCHAR REFERENCES DEPARTMENT(name),
    PRIMARY KEY(aID, department) 
);

CREATE TABLE TICKETTAG (
    tID INTEGER REFERENCES TICKET(id),
    tag VARCHAR REFERENCES TAG(name),
    PRIMARY KEY(tID, tag)
);

CREATE TABLE FAQTAG (
    fID INTEGER REFERENCES FAQITEM(id),
    tag VARCHAR REFERENCES TAG(name),
    PRIMARY KEY (fID, tag)
);

INSERT INTO STATUS VALUES ('open'), ('assigned'), ('closed');
INSERT INTO TAG VALUES ('potato'), ('tomato'), ('banana'), ('apple');

INSERT INTO CLIENT VALUES(25, "onso", "1ff1922a7c24ef4ae794a15f2cb8fbb65527ee7205bfba88f126aef53a7b5d19", "afonso.vo@gmail.com", 2);
INSERT INTO CLIENT VALUES(37, "wololo", "7b868fe521b09b3fbf9a638850235ba1f195c2a2be20777260468aaa269e3268", "locas.minas@gmail.com", 1);

INSERT INTO DEPARTMENT VALUES('Vendas'), ('Suporte'), ('Financeiro');

INSERT INTO AGENTDEPARTMENT VALUES (37, 'Vendas'), (37, 'Financeiro');