CREATE DATABASE IF NOT EXISTS FDUHospital;

CREATE TABLE Patient (
   PatientID int NOT NULL AUTO_INCREMENT ,
   Patient_Name varchar(255),
   Patient_Address varchar(255),
   Diagnosis varchar(255) DEFAULT 'None',
   User_Type varchar(8) NOT NULL DEFAULT 'Patient',
   Username varchar(255),
   Password varchar(255),
   PRIMARY KEY (PatientID)
);
CREATE TABLE Hospital (
   HospitalID int NOT NULL,
   Hospital_Name varchar(255),
   Hospital_Address varchar(255),
   Hospital_City varchar(255),
   PRIMARY KEY (HospitalID)
);
CREATE TABLE Doctor (
   LicenseID int NOT NULL,
   HospitalID int,
   Doctor_Name varchar(255),
   Specialty varchar(255),
   User_Type varchar(8) NOT NULL,
   Password varchar(255) NOT NULL,
   PRIMARY KEY (LicenseID),
   FOREIGN KEY (HospitalID) REFERENCES Hospital(HospitalID)
);
CREATE TABLE Medical_Record (
   RecordID int NOT NULL AUTO_INCREMENT,
   PatientID int NOT NULL,
   LicenseID int NOT NULL,
   Examination_Date date,
   Problem varchar(255),
   PRIMARY KEY (RecordID),
   FOREIGN KEY (PatientID) REFERENCES Patient(PatientID),
   FOREIGN KEY (LicenseID) REFERENCES Doctor(LicenseID)
);
CREATE TABLE Appointment (
   AppointmentID int NOT NULL AUTO_INCREMENT,
   PatientID int NOT NULL,
   LicenseID int NOT NULL,
   Appointment_Date date,
   Problem varchar(255),
   PRIMARY KEY (AppointmentID),
   FOREIGN KEY (PatientID) REFERENCES Patient(PatientID),
   FOREIGN KEY (LicenseID) REFERENCES Doctor(LicenseID)
);