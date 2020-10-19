<?php

# Class implementing a research dissertation report form system
require_once ('reviewable-assessments/reviewableAssessments.php');
class dissertationReport extends reviewableAssessments
{
	# Function to assign defaults additional to the general application defaults
	public function defaults ()
	{
		# Add implementation defaults
		$defaults = array (
			'applicationName'		=> 'Dissertation report form',
			'database'				=> 'dissertationreport',
			'description'			=> 'dissertation report',
			'descriptionPlural'		=> 'Dissertation reports',
			'directorDescription'	=> 'Director of the Undergraduate School',
			'singularMode'			=> true,
		);
		
		# Merge in the default defaults
		$defaults += parent::defaults ();
		
		# Return the defaults
		return $defaults;
	}
	
	
	# Database structure
	public function databaseStructureSpecificFields ()
	{
		# Return the SQL
		return $sql = "
			/* Domain-specific fields */
			`title` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Provisional title',
			`projectDescription` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Description',
			`subject` enum('','Human Geography', 'Physical Geography','Human and Physical combined') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Subject area',
			`topic` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Topic',
			`supervisors` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Supervisors so far',
			`furtherSupervisors` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Further supervision',
			`helpTechniques` enum('','Yes','No') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Help (fieldwork and laboratory techniques)',
			`helpTechniquesDetails` mediumtext COLLATE utf8mb4_unicode_ci COMMENT 'Help (fieldwork and laboratory techniques) - details',
			`helpEquipment` enum('','Yes','No') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Help (equipment)',
			`helpEquipmentDetails` mediumtext COLLATE utf8mb4_unicode_ci COMMENT 'Help (equipment) - details',
			`helpField` enum('','Yes','No') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Help (field data)',
			`helpFieldDetails` mediumtext COLLATE utf8mb4_unicode_ci COMMENT 'Help (field data) - details',
			`helpModelling` enum('','Yes','No') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Help (modelling)',
			`helpModellingDetails` mediumtext COLLATE utf8mb4_unicode_ci COMMENT 'Help (modelling) - details',
			`helpImagery` enum('','Yes','No') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Help (imagery)',
			`helpImageryDetails` mediumtext COLLATE utf8mb4_unicode_ci COMMENT 'Help (imagery) - details',
		";
	}
	
	
	# Function to define the asssessment form template
	public function formTemplateLocal ($data, $watermark)
	{
		$html = '<h3>Section B &#8211; Dissertation information</h3>';
		$html .= $watermark;
		
		# Form fields
		$html .= '
		<br />
		<h4>A. Provisional dissertation title:</h4>
		<p>The title of your dissertation should indicate clearly and accurately the nature and topic of your dissertation. This title should be agreed with your Director of Studies. Subtle changes of wording in the title of the final submitted dissertation, or the addition of a short subtitle which reflects more specifically the nature of the work, will not be penalised by the Part II Examination Board.</p>
		<p>{title}</p>
		
		<br />
		<h4>B. 100 words describing your dissertation research project:</h4>
		<p>These will be used to help the Board of Examiners to allocate markers to dissertations, ensuring appropriate expertise.</p>
		<p>{projectDescription}</p>
		
		<br />
		<h4>C. Chose a subject area your dissertation topic applies to:</h4>
		<p>{subject}</p>
		
		<br />
		<h4>D. Specify what topic it applies to:</h4>
		<p>E.g. Coastal, Climate and Pollution, Natural Hazards, Quaternary; Urban, Economic, Cultural, Historical Geography; Environmental Management, Environment and Society, etc.</p>
		<p>{topic}</p>
		
		<br />
		<h4>E. List all the supervisors you have received substantial (30 minutes or more combined at either Part IB or the early Michaelmas Term Part II) supervision from:</h4>
		<p>Each student is allowed 4 hours of formal dissertation supervision across Parts IB and II. If a student changes his/her topic after submitting the dissertation proposal (plus Risk Assessment and Ethics forms) in the Lent term, then the clock can be reset for the number of dissertation hours allowed.</p>
		<p>{supervisors}</p>
		
		<br />
		<h4>F. List all the supervisors you hope/expect to meet for further supervision:</h4>
		<p>{furtherSupervisors}</p>
		
		<br />
		<h4>G. Technical help - Have you received:</h4>
		
		<table class="graybox questionnaire">
			
			<tr>
				<td>&hellip; Instruction in fieldwork and laboratory techniques to ensure safe and appropriate data collection?</td>
				<td>
					{helpTechniques}<br />
					<p>If Yes give details, e.g. what and from whom:</p>
					{helpTechniquesDetails}
				</td>
			</tr>
			
			<tr>
				<td>&hellip; Technical training for the operation of field and laboratory equipment to ensure safe and appropriate data collection?</td>
				<td>
					{helpEquipment}<br />
					<p>If Yes give details, e.g. what and from whom:</p>
					{helpEquipmentDetails}
				</td>
			</tr>
			
			<tr>
				<td>&hellip; Advice on technical apparatus for measuring and logging field data remotely?</td>
				<td>
					{helpField}<br />
					<p>If Yes give details, e.g. what and from whom:</p>
					{helpFieldDetails}
				</td>
			</tr>
			
			<tr>
				<td>&hellip; Training in mathematical modelling or advanced analytical techniques, including computational help?</td>
				<td>
					{helpModelling}<br />
					<p>If Yes give details, e.g. what and from whom:</p>
					{helpModellingDetails}
				</td>
			</tr>
			
			<tr>
				<td>&hellip; Advice on the availability of remotely sensed imagery, and on the analysis of remotely sensed data using advanced software packages?</td>
				<td>
					{helpImagery}<br />
					<p>If Yes give details, e.g. what and from whom:</p>
					{helpImageryDetails}
				</td>
			</tr>
		</table>
		';
		
		# Final confirmation
		$html .= '
			<h3 class="pagebreak">Confirmation</h3>
			<div class="graybox">
				<p><strong>I confirm the above details are correct: {confirmation}</strong></p>
			</div>
		';
		
		# Return the HTML
		return $html;
	}
}

?>
