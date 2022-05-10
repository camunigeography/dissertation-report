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
			`title` mediumtext NOT NULL COMMENT 'Provisional title',
			`projectDescription` mediumtext NOT NULL COMMENT 'Description',
			`subject` enum('','Physical Geography', 'Human Geography','Physical and Human areas combined') NOT NULL COMMENT 'Subject area',
			`supervisors` mediumtext NOT NULL COMMENT 'Supervisors so far',
			`helpData` enum('','Yes','No') NOT NULL COMMENT 'Help (fieldwork and laboratory techniques)',
			`helpDataDetails` mediumtext COMMENT 'Help (fieldwork and laboratory techniques) - details',
			`helpModelling` enum('','Yes','No') NOT NULL COMMENT 'Help (modelling)',
			`helpModellingDetails` mediumtext COMMENT 'Help (modelling) - details',
			`helpImagery` enum('','Yes','No') NOT NULL COMMENT 'Help (imagery)',
			`helpImageryDetails` mediumtext COMMENT 'Help (imagery) - details',
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
		<p>The title of your dissertation should indicate clearly and accurately the nature and topic of your dissertation. This title should be agreed with your Dissertation Supervisor. Subtle changes of wording in the title of the final submitted dissertation, or the addition of a short subtitle which reflects more specifically the nature of the work, will not be penalised by the Part II Examination Board.</p>
		<p>{title}</p>
		
		<br />
		<h4>B. 100 words describing your dissertation research project:</h4>
		<p>These will be used to help the Board of Examiners to allocate markers to dissertations, ensuring appropriate expertise.</p>
		<p>{projectDescription}</p>
		
		<br />
		<h4>C. Identify a subject area your dissertation topic applies to:</h4>
		<ul>
			<li>Physical Geography areas (e.g. Coastal, Climate and Pollution, Natural Hazards, Quaternary etc.)</li>
			<li>Human Geography areas (e.g. Urban, Economic, Cultural, Historical Geography etc.)</li>
			<li>Physical and Human areas combined (e.g. Environmental Management, Environment and Society etc.)</li>
		</ul>
		<p>{subject}</p>
		
		<br />
		<h4>D. Name of your Dissertation Supervisor:</h4>
		<p>If you have seen or are anticipating seeing more than one person (e.g. your original supervisor has left the Department or gone on sabbatical) since the Easter Term 2020 please give both names. Please also list anyone else who your supervisor may have arranged for you to see. Each student is allowed 4 hours of formal dissertation supervision at Part II.</p>
		<p>{supervisors}</p>
		
		<br />
		<h4>E. Technical help - Have you received any of the following (this is in addition to any help from your Dissertation Supervisor):</h4>
		
		<table class="graybox questionnaire">
			
			<tr>
				<td>&hellip; Training or advice in use of online data sets and their analyses?</td>
				<td>
					{helpData}<br />
					<p>If Yes give details, e.g. what and from whom:</p>
					{helpDataDetails}
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
