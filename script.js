function generateInputs() {

    var numParticipants = document.getElementById("no_of_participants").value;
    var participantFields = document.getElementById("participantFields");
    participantFields.innerHTML = "";
    participantFields.appendChild(document.createElement("br"));

    var numTeachers = document.getElementById("no_of_teachers").value;
    var teacherFields = document.getElementById("teacherFields");
    teacherFields.innerHTML = "";
    teacherFields.appendChild(document.createElement("br"));

    for (var i = 1; i <= numParticipants; i++) {

        var name = document.createElement("input");
        name.type = "text";
        name.name = "participant_" + i + "_name";
        name.id = "participant_" + i + "_name";
        name.placeholder = " Name";
        name.class="form-control";
        name.required = false;

        var clas = document.createElement("input");
        clas.type = "text";
        clas.name = "participant_" + i + "_class";
        clas.id = "participant_" + i + "_class";
        clas.placeholder = " Class";
        clas.class="form-control";
        clas.required = false;

        var roll = document.createElement("input");
        roll.type = "text";
        roll.name = "participant_" + i + "_roll";
        roll.id = "participant_" + i + "_roll";
        roll.placeholder = " Roll Number";
        roll.class="form-control";
        roll.required = false;

        var contact = document.createElement("input");
        contact.type = "tel";
        contact.name = "participant_" + i + "_contact";
        contact.id = "participant_" + i + "_contact";
        contact.placeholder = " Contact Number";
        contact.class="form-control";
        contact.required = false;

        participantFields.appendChild(document.createTextNode("Participant " + i + ": "));
        participantFields.appendChild(name);
        participantFields.appendChild(clas);
        participantFields.appendChild(roll);
        participantFields.appendChild(contact);
        participantFields.appendChild(document.createElement("br"));
        participantFields.appendChild(document.createElement("br"));
    }

    for (var i = 1; i <= numTeachers; i++) {

        var name = document.createElement("input");
        name.type = "text";
        name.name = "teacher_" + i + "_name";
        name.id = "teacher_" + i + "_name";
        name.placeholder = " Name";
        name.class="form-control";
        name.required = true;

        var contact = document.createElement("input");
        contact.type = "tel";
        contact.name = "teacher_" + i + "_contact";
        contact.id = "teacher_" + i + "_contact";
        contact.placeholder = " Contact Number";
        contact.class="form-control";
        contact.required = true;

        var email = document.createElement("input");
        email.type = "email";
        email.name = "teacher_" + i + "_email";
        email.id = "teacher_" + i + "_email";
        email.placeholder = " Email ID";
        email.class="form-control";
        email.required = true;

        teacherFields.appendChild(document.createTextNode("Teacher " + i + ": "));
        teacherFields.appendChild(name);
        teacherFields.appendChild(contact);
        teacherFields.appendChild(email);
        teacherFields.appendChild(document.createElement("br"));
        teacherFields.appendChild(document.createElement("br"));
    }
}