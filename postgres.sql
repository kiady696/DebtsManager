CREATE DATABASE trosa;
CREATE USER kiady with password 'kiady';
GRANT CONNECT ON DATABASE trosa TO kiady;
ALTER DATABASE trosa OWNER TO kiady;
CREATE ROLE su;
ALTER ROLE su SUPERUSER;
GRANT su TO kiady;

-- UTILISATEUR

CREATE TABLE UTILISATEUR(
    id VARCHAR(50) primary key,
    nom VARCHAR(100) not null
);

INSERT INTO UTILISATEUR VALUES('U1','Kiady');
INSERT INTO UTILISATEUR VALUES('U2','Rakoto');

-- FIN UTILISATEUR

-- TROSA

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
INSERT INTO TROSA VALUES('D2','U2','2020-08-22',3000.00,0);

-- FIN TROSA

-- VUE INDEX 

CREATE VIEW getAllTrosa AS 
SELECT
    UTILISATEUR.nom,TROSA.dateTrosa,TROSA.total,TROSA.etat,UTILISATEUR.id,TROSA.idDette
FROM 
    UTILISATEUR,TROSA
WHERE UTILISATEUR.id = TROSA.id_user;

DROP VIEW getAllTrosa;

-- FIN VUE INDEX

--  PAYEMENT A VALIDER 

CREATE TABLE PAYEMENTAVALIDER(
    idPayement VARCHAR(50) primary key,
    idTrosa VARCHAR(50),
    sommePayement DECIMAL(30,2),
    datePayement date
);
alter table PAYEMENTAVALIDER
   add constraint FK_PAYEMENTAVALIDER_REFERENCE_TROSA foreign key (idTrosa)
      references TROSA (idDette)
      on delete restrict on update restrict;

INSERT INTO PAYEMENTAVALIDER VALUES ('P1','D1',500.00,'2020-08-23');
INSERT INTO PAYEMENTAVALIDER VALUES ('P2','D1',400.00,'2020-08-23');
INSERT INTO PAYEMENTAVALIDER VALUES ('P3','D2',850.00,'2020-08-23');

--  FIN PAYEMENT A VALIDER

-- REMBOURSEMENTS 

CREATE TABLE REMBOURSEMENTS(
    idRemboursement VARCHAR(50) primary key,
    idPayement VARCHAR(50),
    idTrosa VARCHAR(50),
    dateRemboursement date
);
alter table REMBOURSEMENTS
   add constraint FK_REMBOURSEMENTS_REFERENCE_PAYEMENTAVALIDER foreign key (idPayement)
      references PAYEMENTAVALIDER (idPayement)
      on delete restrict on update restrict;

alter table REMBOURSEMENTS
   add constraint FK_REMBOURSEMENTS_REFERENCE_TROSA foreign key (idTrosa)
      references TROSA (idDette)
      on delete restrict on update restrict;

INSERT INTO REMBOURSEMENTS VALUES ('R1','P1','D1','2020-08-23'); 
INSERT INTO REMBOURSEMENTS VALUES ('R2','P2','D1','2020-08-23'); 
INSERT INTO REMBOURSEMENTS VALUES ('R3','P3','D2','2020-08-23'); 
DELETE FROM REMBOURSEMENTS WHERE idRemboursement = 'R3';

-- FIN REMBOURSEMENTS 

-- LES VUES REMBOURSEMENTS

-- LE reste a payer sera le montant total du trosa 
--moins la somme des payements à ce trosa qui est dans la table REMBOURSEMENT
--CREATE VIEW getReste AS 
--SELECT
    --TROSA.idDette,TROSA.total - (SELECT sum FROM getRembs WHERE getRembs.idDette = 'D1') as RESTE
--FROM 
    --TROSA,getRembs
--WHERE TROSA.idDette = 'D1';

--DROP VIEW getReste;

--La somme des remboursements déjà validés d'un trosa donné
CREATE VIEW getRembs AS 
SELECT 
    TROSA.idDette,SUM(PAYEMENTAVALIDER.sommePayement)
FROM 
    TROSA,PAYEMENTAVALIDER
WHERE 
    PAYEMENTAVALIDER.idTrosa = TROSA.idDette AND PAYEMENTAVALIDER.idPayement IN (SELECT idPayement FROM REMBOURSEMENTS)
GROUP BY TROSA.idDette;
