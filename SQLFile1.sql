CREATE DATABASE Universiteti;
USE Universiteti;

CREATE TABLE Fakulteti(
    FakultetiID int NOT NULL,
    Emri varchar(60),
    Rruga varchar(80),
    Qyteti varchar(50),
    ZipKodi varchar(20),
    CONSTRAINT PK_Fakulteti PRIMARY KEY (FakultetiID)
);

CREATE TABLE Lenda(
    LendaID int NOT NULL,
    Emri varchar(60),
    ECTS int,
    CONSTRAINT PK_Lenda PRIMARY KEY (LendaID)
);

CREATE TABLE StafiAkademik(
    AsistentiID int NOT NULL,
    FakultetiID int NOT NULL,
    Emri varchar(40),
    Mbiemri varchar(40),
    Datelindja date,
    Vendbanimi varchar(80),
    Orari_Punes varchar(50),
    CONSTRAINT PK_StafiAkademik PRIMARY KEY (AsistentiID),
    CONSTRAINT FK_StafiAkademik_Fakulteti 
        FOREIGN KEY (FakultetiID) REFERENCES Fakulteti(FakultetiID)
);

CREATE TABLE Asistenti(
    AsistentiID int NOT NULL,
    Pervoja int,
    Paga decimal(10,2),
    CONSTRAINT PK_Asistenti PRIMARY KEY (AsistentiID),
    CONSTRAINT FK_Asistenti_StafiAkademik 
        FOREIGN KEY (AsistentiID) REFERENCES StafiAkademik(AsistentiID)
);

CREATE TABLE Profesori(
    ProfesoriID int NOT NULL,
    Hulumtimi varchar(100),
    Licensa varchar(40),
    CONSTRAINT PK_Profesori PRIMARY KEY (ProfesoriID),
    CONSTRAINT FK_Profesori_StafiAkademik 
        FOREIGN KEY (ProfesoriID) REFERENCES StafiAkademik(AsistentiID)
);

CREATE TABLE Studenti(
    StudentiID int NOT NULL,
    Emri varchar(40),
    Mbiemri varchar(40),
    Datelindja date,
    Qyteti varchar(50),
    Rruga varchar(80),
    ZipKodi varchar(20),
    Keshilluesi int NOT NULL,
    AsistentiID int NOT NULL,
    CONSTRAINT PK_Studenti PRIMARY KEY (StudentiID),
    CONSTRAINT FK_Studenti_Keshilluesi 
        FOREIGN KEY (Keshilluesi) REFERENCES Profesori(ProfesoriID),
    CONSTRAINT FK_Studenti_Asistenti 
        FOREIGN KEY (AsistentiID) REFERENCES Asistenti(AsistentiID)
);

CREATE TABLE Ligjeron(
    ProfesoriID int NOT NULL,
    LendaID int NOT NULL,
    CONSTRAINT PK_Ligjeron PRIMARY KEY (ProfesoriID, LendaID),
    CONSTRAINT FK_Ligjeron_Profesori 
        FOREIGN KEY (ProfesoriID) REFERENCES Profesori(ProfesoriID),
    CONSTRAINT FK_Ligjeron_Lenda 
        FOREIGN KEY (LendaID) REFERENCES Lenda(LendaID)
);

CREATE TABLE Ndjek(
    ProfesoriID int NOT NULL,
    LendaID int NOT NULL,
    StudentiID int NOT NULL,
    CONSTRAINT PK_Ndjek PRIMARY KEY (ProfesoriID, LendaID, StudentiID),
    CONSTRAINT FK_Ndjek_Profesori 
        FOREIGN KEY (ProfesoriID) REFERENCES Profesori(ProfesoriID),
    CONSTRAINT FK_Ndjek_Lenda 
        FOREIGN KEY (LendaID) REFERENCES Lenda(LendaID),
