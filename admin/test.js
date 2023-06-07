window.onload = function exampleFunction() {
    document.body.innerHTML = document.body.innerHTML.replace("; ; ; ; ; ;", "");
    jQuery(document).ready(function(a) { a("select").find('option[value="0"]').attr("selected", "selected") });
    createCaptcha()
};
var captchaCode;

function createCaptcha() {
    document.getElementById("captcha").innerHTML = "";
    var a = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ@!#$%^&*";
    var f = 6;
    var d = [];
    for (var e = 0; e < f; e++) { var c = Math.floor(Math.random() * a.length + 1); if (d.indexOf(a[c]) == -1) { d.push(a[c]) } else { e-- } }
    var g = document.createElement("canvas");
    g.id = "captcha";
    g.width = 100;
    g.height = 50;
    var b = g.getContext("2d");
    b.font = "25px Georgia";
    b.strokeText(d.join(""), 0, 30);
    captchaCode = d.join("");
    document.getElementById("captcha").appendChild(g)
}

function validatePressEnterKey() {
    var a = document.getElementById("paymentCodeInput");
    a.addEventListener("keypress", function(b) {
        if (b.key === "Enter") {
            b.preventDefault();
            document.getElementById("ValidateButtonId").click()
        }
    })
}

function goToQuestion() {
    var d = document.getElementById("goToPageComboId").value;
    var a = document.getElementById("totalNumberOfQuestionDiv").innerHTML;
    console.log("questionNo=" + d);
    console.log("totalNumberOfQuestion=" + a);
    if ((a != null) && (a != "")) {
        a = a.toString();
        console.log("str=" + a);
        totalquestion = a.replace(/(<([^>]+)>)/ig, "");
        var c = totalquestion.split(":");
        countDivisionTag = 1;
        console.log("numberPars[1]=" + c[1]);
        var b = "Please wait ... ";
        while (countDivisionTag <= c[1]) {
            console.log("divId=tableId" + countDivisionTag);
            document.getElementById("tableId" + countDivisionTag).style.display = "none";
            document.getElementById("questionTxt" + countDivisionTag).innerHTML = b;
            document.getElementById("Choice1Label" + countDivisionTag).innerHTML = b;
            document.getElementById("Choice2Label" + countDivisionTag).innerHTML = b;
            document.getElementById("Choice3Label" + countDivisionTag).innerHTML = b;
            document.getElementById("Choice4Label" + countDivisionTag).innerHTML = b;
            countDivisionTag = countDivisionTag + 1
        }
        document.getElementById("tableId" + d).style.display = "block";
        fetchQuestionForGoToQuestion(d, "http://elts.com.et/exam-sessions?p_p_id=Examination_WAR_Examinationportlet&p_p_lifecycle=2&p_p_state=normal&p_p_mode=view&p_p_resource_id=goToQuestion&p_p_cacheability=cacheLevelPage&p_p_col_id=column-1&p_p_col_count=1")
    }
}

function fetchQuestionForGoToQuestion(b, a) {
    $.ajax({
        url: a,
        data: { questionNo: b },
        type: "POST",
        dataType: "text",
        success: function(e) {
            var d = e.trim();
            if (d == null) { alert("Error.") } else {
                var c = d.split("SepaChar");
                document.getElementById("questionTxt" + b).innerHTML = c[0];
                document.getElementById("Choice1Label" + b).innerHTML = c[1];
                document.getElementById("Choice2Label" + b).innerHTML = c[2];
                document.getElementById("Choice3Label" + b).innerHTML = c[3];
                document.getElementById("Choice4Label" + b).innerHTML = c[4];
                console.log("Choice4Label=" + c[4])
            }
        }
    })
}

function submitExaminationBtn() {
    document.getElementById("titleForDetailsDiv").innerHTML = "<h3>Please wait ... </h3>";
    document.getElementById("titleForDetailsDiv").style.display = "block";
    submitExamination("http://elts.com.et/exam-sessions?p_p_id=Examination_WAR_Examinationportlet&p_p_lifecycle=2&p_p_state=normal&p_p_mode=view&p_p_resource_id=ExaminationSummary&p_p_cacheability=cacheLevelPage&p_p_col_id=column-1&p_p_col_count=1")
}

function containsOnlyNumbers(a) { return /^([0-9]+)$/.test(a) }

function ValidatePaymnetCodeAndStartExam() {
    event.preventDefault();
    document.getElementById("progressDiv").style.display = "block";
    var c = document.getElementById("paymentCodeInput").value;
    //var h = document.querySelector("#programNameCombo");
    var h = "1";
    var d = document.getElementById("sessionCodeDiv").innerHTML;
    if (document.getElementById("cpatchaTextBox").value != captchaCode) {
        document.getElementById("errorDiv").innerHTML = '<span style="color:red;font-size:1.2em;"> Invalid captcha</span> ';
        document.getElementById("errorDiv").style.display = "block";
        document.getElementById("progressDiv").style.display = "none";
        createCaptcha()
    } else {
        if (h == null) {
            document.getElementById("errorDiv").innerHTML = '<span style="color:red;font-size:1.2em;"> You have no active examination. Please subscribe examination via <a href="http://elts.com.et/exam-settings1">elts.com.et</a></span> ';
            document.getElementById("errorDiv").style.display = "block";
            document.getElementById("progressDiv").style.display = "none"
        } else {
            //if (!containsOnlyNumbers(c)) {
            //    document.getElementById("errorDiv").innerHTML = '<span style="color:red;font-size:1.2em;"> Your payment code is invalid or expired. Please contact system administrators on <a href="http://elts.com.et/contact-us">elts.com.et/contact-us</a> </span>';
            //    document.getElementById("errorDiv").style.display = "block";
            //    document.getElementById("progressDiv").style.display = "none"
            //} else {
            document.getElementById("progressDiv").style.display = "block";
            var b = h.value;
            if (b == "0") {
                document.getElementById("errorDiv").innerHTML = '<span style="color:red;font-size:1.2em;">Please select examination type. If you do not have active examination in the list, please subscribe examination via <a href="http://elts.com.et/exam-settings1">elts.com.et</a> to suscribe for an examination</span> ';
                document.getElementById("errorDiv").style.display = "block"
            } else {
                if (c == null || c.trim().length == 0) {
                    document.getElementById("errorDiv").innerHTML = '<span style="color:red;font-size:1.2em;">Please enter payment code in the text box.</span> ';
                    document.getElementById("errorDiv").style.display = "block"
                } else {
                    function f(i) {
                        document.onkeydown = new Function("return false");
                        setTimeout(function() { navigator.clipboard.writeText("") }, 1000);
                        alert("You are not allowed to take screenshot.")
                    }
                    window.addEventListener("keyup", f, true);
                    document.getElementById("ExaminationSummaryDetails").style.display = "none";
                    document.getElementById("submitExamination").style.display = "none";
                    validatePaymentAndStartExam("http://elts.com.et/exam-sessions?p_p_id=Examination_WAR_Examinationportlet&p_p_lifecycle=2&p_p_state=normal&p_p_mode=view&p_p_resource_id=paymnetCode&p_p_cacheability=cacheLevelPage&p_p_col_id=column-1&p_p_col_count=1");
                    var g = document.getElementById("totalNumberOfQuestionDiv").innerHTML;
                    if ((g != null) && (g != "")) {
                        g = g.toString();
                        console.log("str=" + g);
                        totalquestion = g.replace(/(<([^>]+)>)/ig, "");
                        var j = totalquestion.split(":");
                        var a = '<span>Go to question:</span><select id="goToPageComboId"  name = "goToPageCombooName" onchange="goToQuestion()"> <option value="" selected  disabled > --select question number-- </option>';
                        var e = 1;
                        console.log("totalNumberOfQuestion=" + g);
                        console.log("totalquestion=" + totalquestion);
                        console.log("numberPars[1]=" + j[1]);
                        console.log("numberPars[0]=" + j[0]);
                        while (e <= j[1]) {
                            a = a + '<option value="' + e + '">' + e + "</option>";
                            e = e + 1
                        }
                        a = a + "</select>";
                        document.getElementById("goToPageDiv").innerHTML = a
                    }
                }
            }
            console.log("paymentCode=" + c);
            console.log("sessionCode=" + d)
        }
    }
}
//}

function fetchExamInformation() {
    //var d = document.getElementById("programNameCombo").value;
    var d = "1";
    var c = d.split("@");
    var g = "";
    var f = c[0];
    var b = c[1];
    g = c[2];
    var e = c[3];
    var a = g.replace("$", "");
    document.getElementById("totalNumberOfQuestionDiv").innerHTML = '<span style="font-size: 1.2em">Total number of questions:</span><span style="font-size: 1.2em;"> <b><u>' + f + "</u></b></span>";
    document.getElementById("sessionCodeDiv").innerHTML = a;
    document.getElementById("timeAllowedDiv").innerHTML = "Total time allowed=" + b;
    document.getElementById("totalTimeInformationDiv").innerHTML = '<span style="font-size: 1.2em">Total time allowed:</span><span style="font-size: 1.2em;"> <b><u>' + b + "</u></b></span>";
    document.getElementById("totalNumberOfQuestionDiv").innerHTML = '<span style="font-size: 1.2em">Total number of questions:</span><span style="font-size: 1.2em;"> <b><u>' + f + "</u></b></span>";
    document.getElementById("timeAllocatedDiv").innerHTML = "Total time allowed=" + b;
    document.getElementById("totalTimeLeftDiv").innerHTML = "Total time left=" + e
}

function startExamination() {
    //var c = document.getElementById("programNameCombo");
    var c = "1";
    document.getElementById("ExaminationSummaryDetails").style.display = "none";
    if (c.selectedIndex == "0") {
        document.getElementById("errorDiv").style.display = "block";
        document.getElementById("errorDiv").innerHTML = "Please select a program"
    } else {
        document.getElementById("errorDiv").style.display = "none";
        var a = c.options[c.selectedIndex].value;
        var d = c.options[c.selectedIndex].text;
        document.getElementById("programCodeDivId").innerHTML = a;
        document.getElementById("programNameDivId").innerHTML = d;
        document.getElementById("programNameTrialExamId").innerHTML = d + " free version test";
        document.getElementById("startupDiv").style.display = "none";
        document.getElementById("questionZone").style.display = "block";
        var b = "2:10";
        questionsCountData("http://elts.com.et/exam-sessions?p_p_id=Examination_WAR_Examinationportlet&p_p_lifecycle=2&p_p_state=normal&p_p_mode=view&p_p_resource_id=questionsCount&p_p_cacheability=cacheLevelPage&p_p_col_id=column-1&p_p_col_count=1");
        startTimer(b)
    }
}

function ValidateAnswer(a, e, g) {
    var d = "choices" + a;
    console.log("radioButtonName=" + d);
    var b = document.querySelector('input[name="' + d + '"]:checked');
    var f = "";
    if (b == null) {
        var c = '<div style="color:red"><h2>You did not choose an answer.</h2> </div>';
        document.getElementById("explanationDiv" + a).innerHTML = c
    } else {
        document.getElementById("questionChoice1" + a).disabled = true;
        document.getElementById("questionChoice2" + a).disabled = true;
        document.getElementById("questionChoice3" + a).disabled = true;
        document.getElementById("questionChoice4" + a).disabled = true;
        f = b.value;
        console.log("givenAnswer=" + f);
        prepareCommentsAndSuggession("http://elts.com.et/exam-sessions?p_p_id=Examination_WAR_Examinationportlet&p_p_lifecycle=2&p_p_state=normal&p_p_mode=view&p_p_resource_id=givenAnswer&p_p_cacheability=cacheLevelPage&p_p_col_id=column-1&p_p_col_count=1", f, e, g, a)
    }
}

function back(a, c) {
    if (a == 1) { document.getElementById("back1").style.display = "none" } else {
        document.getElementById("back" + a).style.display = "block";
        var d = "tableId" + a;
        var e = "tableId" + (a - 1);
        document.getElementById(d).style.display = "none";
        document.getElementById(e).style.display = "block";
        console.log("currentDivStr=" + d);
        console.log("backDivStr=" + e);
        var b = a - 1;
        fetchQuestionForNext(b, "http://elts.com.et/exam-sessions?p_p_id=Examination_WAR_Examina…