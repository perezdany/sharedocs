CREATE VIEW fichier_dossiers
(id, nom, mis_en_ligne, date_creation, path, online, folder_id, user_id, groupe_user, created_at, updated_at, nom_folder)
AS SELECT fichiers.id, fichiers.nom, fichiers.mis_en_ligne, fichiers.date_creation, fichiers.path, 
fichiers.online, fichiers.folder_id, fichiers.user_id, fichiers.groupe_user,
fichiers.created_at, fichiers.updated_at, folders.nom_folder

FROM fichiers fichiers, folders folders
WHERE fichiers.folder_id=folders.id