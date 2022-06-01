/*
	# EXERCISE SIX (Bonus)

	1). Single quotes surrounding some of the field names / remove the single quotes 'entity_id'
	2). Single quote surrounding type in where clause / remove the single quotes (keeping the single quotes surround job column word
	3). Single quote on line 24 after the period, needs removing
	4). Single quote on line 23 after J1.field_centre_reference_nid / remove single quote of field name
	5). Single quote on line 26 after J3. needs removing
	6). Line 11 single quote after J4. field name
	7). Single quotes surrounding Left Join table names / remove single quotes
	8). NOT NULL incorrect syntax (should be IS NOT NULL).
*/

SELECT A.nid, A.title, UNIXTIME(A.created) AS created, J4.`field_brand_theme_value` AS brand, 
R1.field_recommendations_value AS rec_id, R2.field_follow_up_in_value AS follow_up_in, 
R3.field_follow_up_status_value AS follow_up_status, 
DATE_ADD(UNIXTIME(A.`created`), INTERVAL R2.field_follow_up_in_value DAY) AS follow_up_date,
DATE_ADD(UNIXTIME(A.`created`), INTERVAL R2.field_follow_up_in_value - 7 DAY) AS follow_up_action_date
FROM node AS A
LEFT JOIN `field_data_field_centre_reference` AS J1 ON A.nid = J1.entity_id
LEFT JOIN `field_data_field_job_status` AS J2 ON A.nid = J2.entity_id
LEFT JOIN `field_data_field_test_job` AS J3 ON A.nid = J3.entity_id
LEFT JOIN `field_data_field_brand_theme` AS J4 ON A.nid = J4.entity_id
LEFT JOIN `field_data_field_recommendations` AS R1 ON A.nid = R1.`entity_id`
LEFT JOIN `field_data_field_follow_up_in` AS R2 ON R1.field_recommendations_value = R2.`entity_id`
LEFT JOIN `field_data_field_follow_up_status` AS R3 ON R1.`field_recommendations_value` = R3.`entity_id`
WHERE `type` = 'job' AND J1.`field_centre_reference_nid` = 1000
AND R2.field_follow_up_in_value NOT NULL AND R2.field_follow_up_in_value != 0
AND J3.`field_test_job_value` != 1 
AND DATE_ADD(UNIXTIME(A.`created`), INTERVAL R2.field_follow_up_in_value - 7 DAY) < DATE_NOW()

