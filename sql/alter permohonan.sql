  ALTER TABLE `permohonan`
	ADD COLUMN `catatan_pembahasan_korlap` VARCHAR(255) NULL DEFAULT NULL AFTER `catatan_kasi_approval_berkas`,
	ADD COLUMN `hasil_bap_korlap` TINYINT(4) NULL DEFAULT NULL AFTER `catatan_pembahasan_korlap`,
	ADD COLUMN `catatan_bap_korlap` VARCHAR(255) NULL DEFAULT NULL AFTER `hasil_bap_korlap`;
SELECT `DEFAULT_COLLATION_NAME` FROM `information_schema`.`SCHEMATA` WHERE `SCHEMA_NAME`='perizinan_palembang';
