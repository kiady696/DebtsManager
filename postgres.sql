CREATE DATABASE trosa;
CREATE USER kiady with password 'kiady';
GRANT CONNECT ON DATABASE trosa TO kiady;
ALTER DATABASE trosa OWNER TO kiady;
CREATE ROLE su;
ALTER ROLE su SUPERUSER;
GRANT su TO kiady;

CREATE TABLE UTILISATEUR(
    id VARCHAR(50) primary key,
    nom VARCHAR(100) not null
);

INSERT INTO UTILISATEUR VALUES('U1','Kiady');

CREATE TABLE TROSA(
    idDette VARCHAR(50) primary key,
    id_user VARCHAR(50),
    dateTrosa date,
    total decimal(30,2),
    etat INT
);
alter table TROSA
   add constraint FK_TROSA_REFERENCE_USER foreign key (ID_USER)
      references UTILISATEUR (ID)
      on delete restrict on update restrict;

INSERT INTO TROSA VALUES('D1','U1','2020-08-17',1000.00,0);

CREATE VIEW getAllTrosa AS 
SELECT
    UTILISATEUR.nom,TROSA.dateTrosa,TROSA.total,TROSA.etat,UTILISATEUR.id,TROSA.idDette
FROM 
    UTILISATEUR,TROSA
WHERE UTILISATEUR.id = TROSA.id_user;

DROP VIEW getAllTrosa;




