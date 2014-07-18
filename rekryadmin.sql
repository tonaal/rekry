CREATE TABLE maintenance (
  id INTEGER UNSIGNED  NOT NULL   AUTO_INCREMENT,
  greenwallid VARCHAR(200)  NULL  ,
  date VARCHAR(200)  NOT NULL  ,
  person VARCHAR(200)  NULL  ,
  report TEXT  NULL  ,
  replacedplants VARCHAR(200)  NULL  ,
  replacedlamps VARCHAR(200)  NULL  ,
  picturebefore VARCHAR(200)  NULL  ,
  pictureafter VARCHAR(200)  NULL  ,
  nutritionadded VARCHAR(200)  NOT NULL  ,
  nutritionadded3 VARCHAR(200)  NULL  ,
  nutritionadded2 VARCHAR(200)  NULL  ,
  waterconductivitybefore VARCHAR(200)  NULL  ,
  waterconductivityafer VARCHAR(200)  NULL    ,
PRIMARY KEY(id));



CREATE TABLE greenwall (
  id INTEGER UNSIGNED  NOT NULL   AUTO_INCREMENT,
  wallId VARCHAR(200)  NULL  ,
  groupid VARCHAR(200)  NULL  ,
  address VARCHAR(100)  NULL  ,
  roominfo VARCHAR(200)  NULL  ,
  timezone VARCHAR(100)  NULL  ,
  installationdate VARCHAR(100)  NULL  ,
  wateringtimer1 VARCHAR(200)  NULL  ,
  wateringtimer2 VARCHAR(200)  NULL  ,
  wateringtimer3 VARCHAR(200)  NULL  ,
  lighttimer1 VARCHAR(200)  NULL  ,
  lighttimer2 VARCHAR(200)  NULL  ,
  ventilationtimer1 VARCHAR(200)  NULL  ,
  ventilationtimer2 VARCHAR(200)  NULL  ,
  ventilationtimer3 VARCHAR(200)  NULL  ,
  other TEXT  NULL    ,
PRIMARY KEY(id));



