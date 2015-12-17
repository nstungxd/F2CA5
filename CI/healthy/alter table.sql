ALTER TABLE `groups` ADD `CenterCode` VARCHAR( 255 ) NULL;
ALTER TABLE `workout` ADD `CenterCode` VARCHAR( 255 ) NULL;
ALTER TABLE `exercise`
  DROP `TypeValue1`,
  DROP `TypeValue2`,
  DROP `TypeValue3`;
