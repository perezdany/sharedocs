CREATE VIEW user_groups
(id, nom_prenomsn, fonction, entreprise, email, password, telephone, groupes_id, active, created_at, updated_at, titre)
AS SELECT users.id, users.email, users.password, users.telephone, users.groupes_id, users.active, users.created_at, users.updated_at, 
groupes.titre

FROM users users, groupes groupes
WHERE users.groupes_id=groupes.id