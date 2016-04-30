CREATE TABLE  Iranyitoszam (
  iranyitoszam NUMBER(4) DEFAULT 1000 PRIMARY KEY,
  varos varchar2(64) DEFAULT '' NOT NULL,
  megye VARCHAR2(77)
);

CREATE TABLE  Termekek(
	kod NUMBER(10) PRIMARY KEY NOT NULL,
	nev VARCHAR2(40) NOT NULL,
	kategoria VARCHAR2(40) NOT NULL, 
	besz_ar NUMBER(10) NOT NULL,
	elad_ar NUMBER(10) NOT NULL,
	eladott_mennyiseg NUMBER(10) NOT NULL,
	felvetel_datuma DATE NOT NULL
);

CREATE TABLE   Vasarlok (
  email VARCHAR2(40) PRIMARY KEY NOT NULL,
  jelszo VARCHAR2(20) NOT NULL,
  nev varchar2(30) NOT NULL ,
  reg_idopont DATE not null,
  bankszamlaszam VARCHAR2(26) NOT NULL,
  egyenleg NUMBER(10)  DEFAULT 0 NOT NULL,
  iranyitoszam NUMBER(4) NOT NULL REFERENCES Iranyitoszam(iranyitoszam), 
  utca VARCHAR2(40) NOT NULL,
  hazszam VARCHAR2(10) NOT NULL
);

CREATE TABLE   Vasarlasok(
    id NUMBER(10)  PRIMARY KEY NOT NULL,
	vasarlo_email VARCHAR2(40) NOT NULL REFERENCES Vasarlok(email),
	felvetel DATE not null
);

CREATE TABLE  Vasarol (
vasarlas_id NUMBER(10) REFERENCES Vasarlasok(id) ,
 termek_kod NUMBER(10) REFERENCES Termekek(kod),
 ar NUMBER(10) NOT NULL,
 mennyiseg NUMBER(10) NOT NULL
 );

CREATE TABLE  Szamlak(
	osszeg NUMBER(10) NOT NULL,
	afa NUMBER(10) NOT NULL,
	sorszam NUMBER(10) PRIMARY KEY NOT NULL,
	kelte DATE DEFAULT SYSDATE NOT NULL,
	vasarlas_id NUMBER(10) NOT NULL REFERENCES Vasarlasok(id),
	vasarlo_email VARCHAR2(40) NOT NULL REFERENCES Vasarlok(email)	
);


CREATE TABLE  Szallitasok(
	id NUMBER(10) PRIMARY KEY NOT NULL,
	esedekesseg DATE,
	elkuldve NUMBER(1) default 0,
	vasarlas_id NUMBER(10) NOT NULL REFERENCES Vasarlasok(id)
);