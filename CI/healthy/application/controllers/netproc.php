<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include("www/include/global.php");
$data['baseDir'] = $baseDir;
/*
|--------------------------------------------------------------------------
| BackEnd Controller
|--------------------------------------------------------------------------
|
| Description
|
*/
class netproc extends CI_Controller {

function __construct()
{
	parent::__construct();
}

/*
|--------------------------------------------------------------------------
| Common Func
|--------------------------------------------------------------------------
| 
|
*/
public function getConsumeCalory($userseq, $prescriptdate) {
	global $TABLE;

	// Consume Calory
	$where = "A.UserSeq='".$userseq."' AND A.ExDate='".$prescriptdate."'";
	$sql = sprintf("
		SELECT A.* FROM %s A INNER JOIN %s B ON A.ExerciseSeq = B.Seq
		WHERE %s", $TABLE['userdailyexercise'], $TABLE['exercise'], $where);
	$data = $this->dbop->execSQL($sql);

	$consumecal = 0;
	foreach ($data as $d) {
		$consumecal += $d->KCal;
	}

	return $consumecal;
}

public function getIntakeCalory($userseq, $prescriptdate) {
	global $TABLE;

	// Intake Calory
	$where = "A.UserSeq='".$userseq."' AND A.Date='".$prescriptdate."'";
	$sql = sprintf("
		SELECT A.*, B.FoodName FROM %s A INNER JOIN %s B ON A.FoodSeq = B.Seq
		WHERE %s", $TABLE['userdailyfood'], $TABLE['food'], $where);
	$data = $this->dbop->execSQL($sql);

	$intakecal = 0;
	$foodlist = array();
	foreach ($data as $d) {
		$intakecal += $d->KCal;
		$foodlist[] = array("Seq"=>$d->Seq, "IntakeKind" => $d->IntakeKind, "FoodName" => $d->FoodName, "Kcal"=>$d->KCal, "Ea"=>$d->Ea);
	}

	return $intakecal;
}

public function getMonthlyConsumeCalory($userseq, $prescriptdate) {
	global $TABLE;

	$monthst = monthstart($prescriptdate);
	$monthen = monthend($prescriptdate);

	// Monthly Consume Calory
	$where = "(A.UserSeq='".$userseq."' AND A.ExDate>='".$monthst."' AND A.ExDate<='".$monthen."')";
	$sql = sprintf("
		SELECT A.* FROM %s A INNER JOIN %s B ON A.ExerciseSeq = B.Seq
		WHERE %s", $TABLE['userdailyexercise'], $TABLE['exercise'], $where);
	$data = $this->dbop->execSQL($sql);

	$consumemonthlycal = 0;
	foreach ($data as $d) {
		$consumemonthlycal += $d->KCal;
	}

	return $consumemonthlycal;
}

public function getMonthlyIntakeCalory($userseq, $prescriptdate) {
	global $TABLE;

	$monthst = monthstart($prescriptdate);
	$monthen = monthend($prescriptdate);

	// Intake Consume Calory
	$where = "(A.UserSeq='".$userseq."' AND A.Date>='".$monthst."' AND A.Date<='".$monthen."')";
	$sql = sprintf("
		SELECT A.* FROM %s A
		WHERE %s", $TABLE['userdailyfood'], $where);
	$data = $this->dbop->execSQL($sql);

	$intakemonthlycal = 0;
	foreach ($data as $d) {
		$intakemonthlycal += $d->KCal;
	}

	return $intakemonthlycal;
}

public function getMonthlyHealthGrade($userseq, $prescriptdate) {
	global $TABLE;

	$monthst = monthstart($prescriptdate);
	$monthen = monthend($prescriptdate);

	// Intake Consume Calory
	$where = "(A.UserSeq='".$userseq."' AND A.Date>='".$monthst."' AND A.Date<='".$monthen."')";
	$sql = sprintf("
		SELECT A.* FROM %s A
		WHERE %s", $TABLE['dailyhealthgrade'], $where);
	$data = $this->dbop->execSQL($sql);

	$grade = 0;
	if (count($data) > 0) {
		foreach ($data as $d) {
			$grade += $d->TotalGrade;
		}
		$grade = $grade/count($data);
		$grade = round($grade);
	}

	return $grade;
}

public function updateAchieveRatio($userseq, $prescriptdate) {
	global $TABLE;

	$this->load->model("achiveratio");
	$this->load->model("userattendhistory");

	$month = month($prescriptdate);

	$ratio1 = 0;
	$attendcount = $this->userattendhistory->getcount($userseq, $prescriptdate);
	if ($attendcount > 30) $ratio1 = 100;
	else if ($attendcount == 0) $ratio1 = 0;
	else $ratio1 = 100*$attendcount/30;

	$ratio2 = 0;
	$where = "A.UserSeq='".$userseq."'";
	$sql = sprintf("
		SELECT SUM(B.KCal) AS totalkcal FROM %s A INNER JOIN %s B ON A.ExerciseSeq = B.Seq
		WHERE %s", $TABLE['userexercise'], $TABLE['exercise'], $where);
	$data = $this->dbop->execSQL($sql);
	if ($data != null) {
		$consumemonthlycal = $this->getMonthlyConsumeCalory($userseq, $prescriptdate);
		$totalkcal = $data[0]->totalkcal;
		if ($totalkcal <= 0) $ratio2 = 0;
		else $ratio2 = abs(100*$consumemonthlycal/(30*$totalkcal));
	}

	$ratio3 = 0;
	$healthgrade = $this->getMonthlyHealthGrade($userseq, $prescriptdate);
	$ratio3 = 100*$healthgrade/100;

	$ratio = round($ratio1*0.4+$ratio2*0.4+$ratio3*0.2);
	$this->achiveratio->register($userseq, $month, $ratio);
}
/*
|--------------------------------------------------------------------------
| Main functions
|--------------------------------------------------------------------------
| 
|
*/
public function getCenterList()
{
	$this->load->model("center");
	try {
		$centerlist = $this->center->all();
		echo json_capsule(array('Response' => 'Success', 'CenterList' => $centerlist));
	}
	catch (Exception $e) {
		echo json_capsule(array('Response' => 'Fail', 'RtMsg'=>'Failed to get center list.', 'Error'=>$e->getMessage()));
	}
}

public function checkId()
{
	$this->load->model("user");
	$userid = $this->input->post("UserID");
	try {
		if (!$this->user->is_reg_userid($userid)) {
			echo json_capsule(array('Response' => 'Success'));
		}
		else {
			echo json_capsule(array('Response' => 'Fail', 'RtMsg' => 'The user id is duplicated.'));
		}
	}
	catch (Exception $e) {
		echo json_capsule(array('Response' => 'Fail', 'RtMsg'=>'Failed to check user id', 'Error'=>$e->getMessage()));
	}
}

public function registerUser()
{
	$userid = $this->input->post("UserID");
	$username = $this->input->post("Name");
	$password = $this->input->post("Password");
	$birthday = $this->input->post("Birthday");
	$sex = $this->input->post("Sex");
	$phone = $this->input->post("Phone");
	$email = $this->input->post("Email");
	$height = $this->input->post("Height");
	$centercode = $this->input->post("CenterCode");

	$this->load->model("user");
	try {
		$id = $this->user->add(array(
				"CenterCode" => $centercode,
				"UserID" => $userid,
				"UserPW" => encpassword($password),
				"UserNm" => $username,
				"BirthDt" => $birthday,
				"Sex" => $sex,
				"Phone" => $phone,
				"Email" => $email,
				"Height" => $height
			));

		echo json_capsule(array(
			"Response" => "Success",
			"UserSeq" => $id,
			"UserID" => $userid,
			"UserPW" => $password,
			"CenterCode" => $centercode,
			"UserSex" => $sex,
			"UserName" => $username));
	}
	catch (Exception $e) {
		echo json_capsule(array('Response' => 'Fail', 'RtMsg'=>'Failed to register user', 'Error'=>$e->getMessage()));
	}
}

public function login()
{
	$userid = $this->input->post("UserID");
	$password = $this->input->post("UserPW");

	try {
		$this->load->model("user");
		$this->load->model("userattendhistory");

		$user = $this->user->get_by_userid($userid);
		if ($user != null && $user->UserPW == encpassword($password)) {
			$this->userattendhistory->add(array(
				"UserSeq" => $user->Seq,
				"UserID" => $user->UserID,
				"UserNm" => $user->UserNm,
				"AttendDt" => now()
				));

			echo json_capsule(array(
				"Response" => "Success",
				"UserSeq" => $user->Seq,
				"CenterCode" => $user->CenterCode,
				"UserID" => $user->UserID,
				"UserPW" => $password,
				"UserSex" => $user->Sex,
				"UserName" => $user->UserNm));
		}
		else {
			echo json_capsule(array("Response" => "Fail", 'RtMsg'=>"Failed to login user."));
		}
	}
	catch (Exception $e) {
		echo json_capsule(array("Response" => "Fail", 'RtMsg'=>'Failed to login user', 'Error'=>$e->getMessage()));
	}
}

public function changePassword()
{
	$userid = $this->input->post("UserID");
	$oldpwd = $this->input->post("OldPwd");
	$newpwd = $this->input->post("NewPwd");

	$this->load->model("user");
	try {
		$user = $this->user->get_by_userid($userid);
		if ($user != null && $user->UserPW == encpassword($oldpwd)) {
			$this->user->change_password($userid, encpassword($newpwd));
			echo json_capsule(array('Response' => 'Success'));
		}
		else {
			echo json_capsule(array('Response' => 'Fail', 'RtMsg'=>'The user ID or password is not correct.'));
		}
	}
	catch (Exception $e) {
		echo json_capsule(array('Response' => 'Fail', 'RtMsg'=>'Failed to change password', 'Error'=>$e->getMessage()));
	}
}

public function getHomeData()
{
	$userseq = $this->input->post("UserSeq");
	$prescriptdate = $this->input->post("PrescriptDate");

	$this->load->model("user");
	$this->load->model("achiveratio");
	$this->load->model("userattendhistory");
	$this->load->model("dailyhealthgrade");

	$this->updateAchieveRatio($userseq, $prescriptdate);

	try {
		$month = month($prescriptdate);
		$achiveratio = $this->achiveratio->getratio($userseq, $month);
		$attendcount = $this->userattendhistory->getcount($userseq, $prescriptdate);
		$consumemonthlycal = $this->getMonthlyConsumeCalory($userseq, $prescriptdate);
		$healthgrade = $this->getMonthlyHealthGrade($userseq, $prescriptdate);

		echo json_capsule(array(
			'Response' => 'Success',
			'AchiveRatio' => $achiveratio, 
			'AttendCount' => $attendcount, 
			'ConsumeCalories' => round($consumemonthlycal), 
			'HealthGrade' => $healthgrade));
	}
	catch (Exception $e) {
		echo json_capsule(array('Response' => 'Fail', 'RtMsg'=>'Failed to get data', 'Error'=>$e->getMessage()));
	}
}

public function getTodayExercise()
{
	$userseq = $this->input->post("UserSeq");
	$prescriptdate = $this->input->post("PrescriptDate");

	$this->load->model("userdailyexercise");
	$this->load->model("exercise");
	$this->load->model("userexercise");

	try {
		global $TABLE;

		$where = "A.UserSeq='".$userseq."'";
		$sql = sprintf("
			SELECT A.* FROM %s A INNER JOIN %s B ON A.ExerciseSeq = B.Seq
			WHERE %s", $TABLE['userexercise'], $TABLE['exercise'], $where);
		$data = $this->dbop->execSQL($sql);

		foreach ($data as $d) {
			$userexerciseseq = $d->Seq;
			$ude = $this->userdailyexercise->get(array("UserSeq"=>$userseq, "UserExerciseSeq"=>$userexerciseseq, "ExDate"=>$prescriptdate));
			if ($ude == null) {
				$seq = $this->userdailyexercise->add(array(
					"UserSeq" => $userseq,
					"ExerciseSeq" => $d->ExerciseSeq,
					"UserExerciseSeq" => $userexerciseseq,
					"ExPro1" => "0",
					"ExPro2" => "0",
					"ExPro3" => "0",
					"ExDate" => $prescriptdate,
					"Status" => "0",
					"KCal" => "0"
				));
			}
		}

		$where = "A.UserSeq='".$userseq."' AND A.ExDate='".$prescriptdate."'";
		$sql = sprintf("
			SELECT A.*, B.Pro1, B.Pro2, B.Pro3, C.Name AS Name, C.Type AS Type, C.ExCode FROM 
				%s A 
				INNER JOIN %s B ON A.UserExerciseSeq = B.Seq
				INNER JOIN %s C ON A.ExerciseSeq = C.Seq
			WHERE %s",
			$TABLE['userdailyexercise'],
			$TABLE['userexercise'],
			$TABLE['exercise'],
			$where);

		$data = $this->dbop->execSQL($sql);

		$list = array();
		foreach ($data as $d) {
			if ($ude != null) {
				$expro1 = $ude->ExPro1;
				$expro2 = $ude->ExPro2;
				$expro3 = $ude->ExPro3;
				$status = $ude->Status;
			}

			$list[] = array(
				"Seq"=>$d->Seq,
				"Name"=>$d->Name,
				"Type"=>$d->Type,
				"Pro1"=>$d->Pro1,
				"Pro2"=>$d->Pro2,
				"Pro3"=>$d->Pro3,
				"ExCode" => $d->ExCode,
				"ExPro1"=>$d->ExPro1,
				"ExPro2"=>$d->ExPro2,
				"ExPro3"=>$d->ExPro3,
				"Status" => $d->Status);
		}

		echo json_capsule(array('Response' => 'Success', 'ExerciseList' => $list));
	}
	catch (Exception $e) {
		echo json_capsule(array('Response' => 'Fail', 'RtMsg'=>'Failed to get today exercises.', 'Error'=>$e->getMessage()));
	}
}

public function setTodayExHistory()
{
	$userseq = $this->input->post("UserSeq");
	$prescriptdate = $this->input->post("PrescriptDate");
	$exseq = $this->input->post("ExSeq");
	$expro1 = $this->input->post("ExPro1");
	$expro2 = $this->input->post("ExPro2");
	$expro3 = $this->input->post("ExPro3");

	$this->load->model("userdailyexercise");
	$this->load->model("userexercise");
	$this->load->model("exercise");

	try {
		$ude = $this->userdailyexercise->get(array("Seq" => $exseq));
		if ($ude != null) {
			$exercise = $this->exercise->get(array("Seq" => $ude->ExerciseSeq));
			$userexercise = $this->userexercise->get(array("Seq" => $ude->UserExerciseSeq));
			if ($exercise != null && $userexercise != null) {

				if ($userexercise->Pro1 == $expro1)
					$status = 2;
				else if ($expro1 == "0" || $expro1 == 0)
					$status = 0;
				else
					$status = 1;

				if ($exercise->Type == 1 || $exercise->Type == 2)
					$kcal = $expro2;
				else
					$kcal = $exercise->KCal * $expro1 / $userexercise->Pro1;
				
				$this->userdailyexercise->update(
					array(
						"Seq" => $ude->Seq
					),
					array(
						"ExPro1" => $expro1,
						"ExPro2" => $expro2,
						"ExPro3" => $expro3,
						"Status" => $status,
						"KCal" => $kcal
				));

				echo json_capsule(array('Response' => 'Success'));
			}
			else {
				echo json_capsule(array('Response' => 'Fail', 'RtMsg'=>'The exercise is not registered.'));
			}
		}
		else {
			echo json_capsule(array('Response' => 'Fail', 'RtMsg'=>'The exercise is not registered.'));
		}
	}
	catch (Exception $e) {
		echo json_capsule(array('Response' => 'Fail', 'RtMsg'=>'Failed to set today exercises.', 'Error'=>$e->getMessage()));
	}
}

public function getMonthlyReport()
{
	$userseq = $this->input->post("UserSeq");
	$prescriptdate = $this->input->post("PrescriptDate");

	$this->load->model("achiveratio");

	try {
		$ratio = array();
		$ratio[] = $this->achiveratio->getratio($userseq, month($prescriptdate));
		$ratio[] = $this->achiveratio->getratio($userseq, monthbefore2(1, $prescriptdate));
		$ratio[] = $this->achiveratio->getratio($userseq, monthbefore2(2, $prescriptdate));
		$ratio[] = $this->achiveratio->getratio($userseq, monthbefore2(3, $prescriptdate));
		$ratio[] = $this->achiveratio->getratio($userseq, monthbefore2(4, $prescriptdate));
		$ratio[] = $this->achiveratio->getratio($userseq, monthbefore2(5, $prescriptdate));

		$healthgrade = $this->getMonthlyHealthGrade($userseq, $prescriptdate);
		echo json_capsule(array('Response' => 'Success', 'AchiveRatio' => $ratio, 'MonthRatio' => $ratio[0], 'HealthGrade' => $healthgrade));
	}
	catch (Exception $e) {
		echo json_capsule(array('Response' => 'Fail', 'RtMsg'=>'Failed to set today exercises.', 'Error'=>$e->getMessage()));
	}
}
////////////////////////////////////////////
public function getLifeHabit()
{
	$userseq = $this->input->post("UserSeq");
	$prescriptdate = $this->input->post("PrescriptDate");

	$this->load->model("dailyhealthgrade");
	try {
		$dhg = $this->dailyhealthgrade->get(array(
			"UserSeq" => $userseq,
			"Date" => $prescriptdate
		));
		if ($dhg != null) {
			echo json_capsule(array(
				'Response' => 'Success',
				'HealthGrade' => round($dhg->TotalGrade),
				'Grade1' => $dhg->Grade1,
				'Grade2' => $dhg->Grade2,
				'Grade3' => $dhg->Grade3,
				'Grade4' => $dhg->Grade4,
				'Grade5' => $dhg->Grade5,
				'Grade6' => $dhg->Grade6,
				'Grade7' => $dhg->Grade7,
				'Grade8' => $dhg->Grade8,
				'Grade9' => $dhg->Grade9
			));
		}
		else {
			echo json_capsule(array('Response' => 'Fail', 'RtMsg'=>''));
		}
	}
	catch (Exception $e) {
		echo json_capsule(array('Response' => 'Fail', 'RtMsg'=>'Failed to get life habit.', 'Error'=>$e->getMessage()));
	}
}

public function setLifeHabit()
{
	$userseq = $this->input->post("UserSeq");
	$prescriptdate = $this->input->post("PrescriptDate");
	$grade1 = $this->input->post("Grade1");
	$grade2 = $this->input->post("Grade2");
	$grade3 = $this->input->post("Grade3");
	$grade4 = $this->input->post("Grade4");
	$grade5 = $this->input->post("Grade5");
	$grade6 = $this->input->post("Grade6");
	$grade7 = $this->input->post("Grade7");
	$grade8 = $this->input->post("Grade8");
	$grade9 = $this->input->post("Grade9");

	$this->load->model("dailyhealthgrade");
	try {
		$health = calcHealthGrade($grade1, $grade2, $grade3, $grade4, $grade5, $grade6, $grade7, $grade8, $grade9);
		
		if ($this->dailyhealthgrade->get(array("UserSeq"=>$userseq, "Date"=>$prescriptdate)) == null) {
			$this->dailyhealthgrade->add(array(
					"UserSeq" => $userseq,
					"Grade1" => $grade1,
					"Grade2" => $grade2,
					"Grade3" => $grade3,
					"Grade4" => $grade4,
					"Grade5" => $grade5,
					"Grade6" => $grade6,
					"Grade7" => $grade7,
					"Grade8" => $grade8,
					"Grade9" => $grade9,
					"TotalGrade" => $health,
					"Date" => $prescriptdate
				));
		}
		else {
			$this->dailyhealthgrade->update(
				array(
					"Grade1" => $grade1,
					"Grade2" => $grade2,
					"Grade3" => $grade3,
					"Grade4" => $grade4,
					"Grade5" => $grade5,
					"Grade6" => $grade6,
					"Grade7" => $grade7,
					"Grade8" => $grade8,
					"Grade9" => $grade9,
					"TotalGrade" => $health
				),
				array(
					"UserSeq" => $userseq,
					"Date" => $prescriptdate
				));
		}

		echo json_capsule(array(
				'Response' => 'Success',
				'HealthGrade' => round($health)
			));
	}
	catch (Exception $e) {
		echo json_capsule(array('Response' => 'Fail', 'RtMsg'=>'Failed to set life habit.', 'Error'=>$e->getMessage()));
	}
}

public function getTodayCalory()
{
	$userseq = $this->input->post("UserSeq");
	$prescriptdate = $this->input->post("PrescriptDate");

	try {
		global $TABLE;

		$monthst = monthstart($prescriptdate);
		$monthen = monthend($prescriptdate);

		$consumecal = $this->getConsumeCalory($userseq, $prescriptdate);
		$intakecal = $this->getIntakeCalory($userseq, $prescriptdate);
		$consumemonthlycal = $this->getMonthlyConsumeCalory($userseq, $prescriptdate);
		$intakemonthlycal = $this->getMonthlyIntakeCalory($userseq, $prescriptdate);

		// Intake Calory
		$where = "A.UserSeq='".$userseq."' AND A.Date='".$prescriptdate."'";
		$sql = sprintf("
			SELECT A.*, B.FoodName FROM %s A INNER JOIN %s B ON A.FoodSeq = B.Seq
			WHERE %s", $TABLE['userdailyfood'], $TABLE['food'], $where);
		$data = $this->dbop->execSQL($sql);
		$foodlist = array();
		foreach ($data as $d) {
			$foodlist[] = array("Seq"=>$d->Seq, "IntakeKind" => $d->IntakeKind, "FoodName" => $d->FoodName, "Kcal"=>$d->KCal, "Ea"=>$d->Ea);
		}

		$calory = $intakecal - $consumecal;
		$monthlycalory = $intakemonthlycal - $consumemonthlycal;

		echo json_capsule(array(
			'Response' => 'Success',
			'TodayCalory' => $calory,
			'TodayConsumeCalory' => $consumecal,
			'TodayIntakeCalory' => $intakecal,
			'ConsumeCalory' => $consumemonthlycal,
			'IntakeCalory' => $intakemonthlycal,
			'FoodList' => $foodlist
		));
	}
	catch (Exception $e) {
		echo json_capsule(array('Response' => 'Fail', 'RtMsg'=>'Failed to get today calory.', 'Error'=>$e->getMessage()));
	}
	
}

///////////////////////////////////////////////////////////////////////////////////////////////
public function searchFood()
{
	$searchdata = $this->input->post("data");
	try {
		global $TABLE;

		$this->load->model("food");
		$where = "(A.FoodName LIKE '%".$searchdata."%')";
		$sql = sprintf("
				SELECT A.* FROM %s A WHERE %s ORDER BY Seq asc",
				$TABLE["food"],
				$where
			);

		$list = $this->dbop->execSQL($sql);
		$outarr = array();
		foreach ($list as $d) {
			$outarr[] = array("FoodSeq"=>$d->Seq, "FoodName"=>$d->FoodName, "KCal"=>$d->KCal);
		}

		echo json_capsule(array(
			'Response' => 'Success',
			'FoodList' => $outarr
		));
	}
	catch (Exception $e) {
		echo json_capsule(array('Response' => 'Fail', 'RtMsg'=>'Failed to search food.', 'Error'=>$e->getMessage()));
	}
}

public function getDailyFood()
{
	$userseq = $this->input->post("UserSeq");
	$prescriptdate = $this->input->post("PrescriptDate");

	$this->load->model("userdailyfood");
	try {
		$list = $this->userdailyfood->lists(array("UserSeq"=>$userseq, "Date"=>$prescriptdate));
		$outarr = array();

		foreach ($list as $d) {
			$outarr[] = array(
				"Seq"=>$d->Seq,
				"FoodSeq"=>$d->FoodSeq,
				"Ea"=>$d->Ea,
				"KCal"=>$d->KCal,
				"IntakeKind"=>$d->IntakeKind,
				"FoodName"=>$d->FoodName);
		}

		echo json_capsule(array('Response' => 'Success', 'DailyFoodList' => $outarr));
	}
	catch (Exception $e) {
		echo json_capsule(array('Response' => 'Fail', 'RtMsg'=>'Failed to get daily food.', 'Error'=>$e->getMessage()));
	}
}

public function setDailyFood()
{
	$userseq = $this->input->post("UserSeq");
	$prescriptdate = $this->input->post("PrescriptDate");
	$foodseq = $this->input->post("FoodSeq");
	$ea = $this->input->post("Ea");
	$intakekind = $this->input->post("IntakeKind");

	$this->load->model("userdailyfood");
	$this->load->model("food");

	try {
		$food = $this->food->get(array("Seq"=>$foodseq));

		$foodcal = $food->KCal;
		if ($ea == "0.5") $foodcal = $foodcal/2;
		else if ($ea == "1") $foodcal = $foodcal;
		else if ($ea == "1.5") $foodcal = $foodcal*1.5;
		else if ($ea == "2") $foodcal = $foodcal*2;

		if ($food != null) {
			$seq = $this->userdailyfood->add(array(
				'UserSeq' => $userseq,
				'FoodSeq' => $foodseq,
				'IntakeKind' => $intakekind,
				'Ea' => $ea,
				'Date' => $prescriptdate,
				'KCal' => $foodcal,
				'FoodName' => $food->FoodName
			));
			echo json_capsule(array('Response' => 'Success', 'Seq' => $seq));
		}
		else {
			echo json_capsule(array('Response' => 'Fail', 'RtMsg'=>'The food is not registered.'));
		}
	}
	catch (Exception $e) {
		echo json_capsule(array('Response' => 'Fail', 'RtMsg'=>'Failed to set daily food.', 'Error'=>$e->getMessage()));
	}
}

public function delDailyFood()
{
	$seq = $this->input->post("DailyFoodSeq");
	$this->load->model("userdailyfood");
	try {
		$this->userdailyfood->delete(array("Seq"=>$seq));
		echo json_capsule(array('Response' => 'Success'));
	}
	catch (Exception $e) {
		echo json_capsule(array('Response' => 'Fail', 'RtMsg'=>'Failed to delete daily food.', 'Error'=>$e->getMessage()));
	}
}

public function getExerciseWithNfc()
{
	$userseq = $this->input->post("UserSeq");
	$prescriptdate = $this->input->post("PrescriptDate");
	$nfc = $this->input->post("Nfc");

	$this->load->model("equipment");
	$this->load->model("user");
	$this->load->model("userexercise");

	try {
		$equip = $this->equipment->get(array("NFCCode"=>$nfc));
		$user = $this->user->get($userseq);

		if ($equip == null) {
			echo json_capsule(array('Response' => 'NoReg', 'RtMsg'=>'Unknown NFC machine'));
		}
		else if ($user == null) {
			echo json_capsule(array('Response' => 'NoReg', 'RtMsg'=>'Unregistered user'));
		}
		else if ($user->CenterCode != $equip->CenterCode) {
			echo json_capsule(array('Response' => 'NoReg', 'RtMsg'=>'This NFC machine is not registered in your center.'));
		}
		else {
			$exseq = $equip->ExerciseSeq;

			$userex = $this->userexercise->get(array("UserSeq"=>$userseq, "ExerciseSeq"=>$exseq));
			if ($userex == null) {
				echo json_capsule(array('Response' => 'NoReg', 'RtMsg'=>'This exercise is not registered in your exercise list.'));
			}
			else {
				echo json_capsule(array('Response' => 'Success', 'ExSeq' => $userex->Seq));
			}
		}
	}
	catch (Exception $e) {
		echo json_capsule(array('Response' => 'Fail', 'RtMsg'=>'Unknown NFC machine', 'Error'=>$e->getMessage()));
	}
}

public function getExDescriptionInfo()
{
	$userseq = $this->input->post("UserSeq");
	$prescriptdate = $this->input->post("PrescriptDate");
	$extype = $this->input->post("ExType");

	$this->load->model("constant");
	try {
		$constant = $this->constant->get(array("c_name"=>$extype));
		if ($constant == null) {
			echo json_capsule(array('Response' => 'Fail', 'RtMsg'=>'Unknown Exercise'));
		}
		else {
			echo json_capsule(array(
				'Response' => 'Success',
				'URL' => $constant->c_value,
				'DESC' => $constant->c_description,
			));
		}
	}
	catch (Exception $e) {
		echo json_capsule(array('Response' => 'Fail', 'RtMsg'=>'Unknown Exercise', 'Error'=>$e->getMessage()));
	}
}

public function getPolicy()
{
	$this->load->model("constant");
	try {
		$agreement = $this->constant->get(array("c_name"=>"agreement"));
		$policy = $this->constant->get(array("c_name"=>"policy"));

		$ag = "";
		$po = "";

		if ($agreement != null) $ag = $agreement->c_value;
		if ($policy != null) $po = $policy->c_value;

		echo json_capsule(array('Response' => 'Success', 'Agreement'=>$ag, 'Policy'=>$po));
	}
	catch (Exception $e) {
		echo json_capsule(array('Response' => 'Fail', 'RtMsg'=>'Failed to get policy', 'Error'=>$e->getMessage()));
	}
}

}
?>