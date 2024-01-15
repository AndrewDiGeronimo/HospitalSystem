
/* Doctor Created Patient Values */

INSERT INTO Patient (PatientID, Patient_Name, Patient_Address, Diagnosis, User_Type)
VALUES (1, 'Bradford Barajas', '66 West Whitemarsh Ave. Montclair, NJ 07042', 'Fractured left shoulder', "Patient");

INSERT INTO Patient (PatientID, Patient_Name, Patient_Address, Diagnosis, User_Type)
VALUES (2, 'Roman Schneider', '72B Ann Street Morristown, NJ 07960', 'Broken collar bone', "Patient");

INSERT INTO Patient (PatientID, Patient_Name, Patient_Address, Diagnosis, User_Type)
VALUES (3, 'Julie Gonzalez', '1 Campus Dr Parsippany, NJ, 07054', 'Chondrolysis, hip', "Patient");

INSERT INTO Patient (PatientID, Patient_Name, Patient_Address, Diagnosis, User_Type)
VALUES (4, 'Mona Booker', '101 Columbia Rd Morristown, NJ, 07960', 'Food poisoning', "Patient");

/* User Created Patient Values */
INSERT INTO Patient (PatientID, Patient_Name, Patient_Address, Diagnosis, User_Type, Username, Password)
VALUES (5, 'Bradford Barajas', '66 West Whitemarsh Ave. Montclair, NJ 07042', 'Fractured left shoulder', "Patient", "BradBara", "123");

/*Hospital Values */

INSERT INTO Hospital (HospitalID, Hospital_Name, Hospital_Address, Hospital_City)
VALUES (1, 'FDU Hospital', '1000 River Rd, Teaneck, NJ 07666', 'Teaneck');

INSERT INTO Hospital (HospitalID, Hospital_Name, Hospital_Address, Hospital_City)
VALUES (2, 'HMH Hackensack University Medical Center', '30 Prospect Ave, Hackensack, NJ 07601', 'Hackensack');

INSERT INTO Hospital (HospitalID, Hospital_Name, Hospital_Address, Hospital_City)
VALUES (3, 'VA New Jersey Health Care System', '385 Prospect Ave, Hackensack, NJ 07601', 'Hackensack');


/* Medical Record Values */

INSERT INTO Medical_Record(RecordID, PatientID, LicenseID, Examination_Date, Problem)
VALUES (1, 1, 1, '2012-10-3', 'Injured left shoulder');

INSERT INTO Medical_Record(RecordID, PatientID, LicenseID, Examination_Date, Problem)
VALUES (2, 1, 1, '2018-9-2', 'Chest pain');

INSERT INTO Medical_Record(RecordID, PatientID, LicenseID, Examination_Date, Problem)
VALUES (3, 2, 2, '2020-1-15', 'Hip pain');

/* Doctor Values */

INSERT INTO Doctor(LicenseID, HospitalID, Doctor_Name, Specialty, User_Type, Password)
VALUES (0, 1, 'Bill Nye', 'Administrator', 'Admin', 'Admin');

INSERT INTO Doctor(LicenseID, HospitalID, Doctor_Name, Specialty, User_Type, Password)
VALUES (1, 1, 'Tiffany Ryan', 'Surgery', 'Doctor', '123');

INSERT INTO Doctor(LicenseID, HospitalID, Doctor_Name, Specialty, User_Type, Password)
VALUES (2, 2, 'Justin Sullivan', 'Pediatrics', 'Doctor', '321');

/* Appointment Values */

INSERT INTO Appointment(AppointmentID, PatientID, LicenseID, Appointment_Date, Problem)
VALUES (1,5,1,'2020-1-15', 'Hip pain')