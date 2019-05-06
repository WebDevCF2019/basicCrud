# les rubriques pour le menu
SELECT idrubrique, theintitule FROM rubrique ORDER BY theintitule ASC;

# les articles pour la homepage par date descendante, avec l'auteur, lorsqu'ils sont visibles
SELECT article.idarticle, article.thetitle,LEFT(article.thetext,300) AS thetext, article.thedate,
	   users.thename,
       GROUP_CONCAT(rubrique.idrubrique ORDER BY rubrique.theintitule) AS idrubrique, 
       GROUP_CONCAT(rubrique.theintitule ORDER BY rubrique.theintitule SEPARATOR '|@|') AS theintitule
	FROM article
    INNER JOIN users
		ON users.idusers = article.users_idusers
    LEFT JOIN article_has_rubrique
		ON article_has_rubrique.article_idarticle = article.idarticle
    LEFT JOIN rubrique
		ON article_has_rubrique.rubrique_idrubrique = rubrique.idrubrique
	WHERE article.thevisibility=1
    GROUP BY article.idarticle
    ORDER BY article.thedate DESC
;

# idem avec alias de tables
SELECT a.idarticle, a.thetitle,LEFT(a.thetext,300) AS thetext, a.thedate,
	   u.thename,
       GROUP_CONCAT(r.idrubrique ORDER BY r.theintitule) AS idrubrique, 
       GROUP_CONCAT(r.theintitule ORDER BY r.theintitule SEPARATOR '|@|') AS theintitule
	FROM article a
    INNER JOIN users u
		ON u.idusers = a.users_idusers
    LEFT JOIN article_has_rubrique h
		ON h.article_idarticle = a.idarticle
    LEFT JOIN rubrique r
		ON h.rubrique_idrubrique = r.idrubrique
	WHERE a.thevisibility=1
    GROUP BY a.idarticle
    ORDER BY a.thedate DESC
;

# affichage d'un article complet avec sesjointures

SELECT a.thetitle, a.thetext, a.thedate,
	   u.thename,
       GROUP_CONCAT(r.idrubrique ORDER BY r.theintitule) AS idrubrique, 
       GROUP_CONCAT(r.theintitule ORDER BY r.theintitule SEPARATOR '|@|') AS theintitule
	FROM article a
    INNER JOIN users u
		ON u.idusers = a.users_idusers
    LEFT JOIN article_has_rubrique h
		ON h.article_idarticle = a.idarticle
    LEFT JOIN rubrique r
		ON h.rubrique_idrubrique = r.idrubrique
	WHERE a.thevisibility=1 AND a.idarticle=1
    GROUP BY a.idarticle
;

# affichage d'une catégorie complète grace à son id
SELECT * FROM rubrique WHERE idrubrique=1;




#prepa grande requête
SELECT art.idarticle FROM rubrique rub
					INNER JOIN article_has_rubrique has 
						ON has.rubrique_idrubrique = rub.idrubrique
					INNER JOIN article art 
						ON art.idarticle = has.article_idarticle
					WHERE has.rubrique_idrubrique=3 
                    ORDER BY rub.theintitule ASC;
                    
SELECT ha.rubrique_idrubrique FROM article_has_rubrique ha
 WHERE ha.article_idarticle IN (2,4);      


SELECT a.idarticle, a.thetitle,LEFT(a.thetext,300) AS thetext, a.thedate,
	   u.thename,
       GROUP_CONCAT(r.idrubrique ORDER BY r.theintitule) AS idrubrique, 
       GROUP_CONCAT(r.theintitule ORDER BY r.theintitule SEPARATOR '|@|') AS theintitule
	FROM article a
    INNER JOIN users u
		ON u.idusers = a.users_idusers
    INNER JOIN article_has_rubrique h
		ON h.article_idarticle = a.idarticle
    INNER JOIN rubrique r
		ON h.rubrique_idrubrique = r.idrubrique
	WHERE a.thevisibility=1
		AND a.idarticle IN (2,4)
        AND h.rubrique_idrubrique IN (2,3,5)  
        GROUP BY a.idarticle
    ORDER BY a.thedate DESC;    
    
    

# les articles présents dans une rubrique par date descendante, avec l'auteur, lorsqu'ils sont visibles
SELECT a.idarticle, a.thetitle,LEFT(a.thetext,300) AS thetext, a.thedate,
	   u.thename,
       GROUP_CONCAT(r.idrubrique ORDER BY r.theintitule) AS idrubrique, 
       GROUP_CONCAT(r.theintitule ORDER BY r.theintitule SEPARATOR '|@|') AS theintitule
	FROM article a
    INNER JOIN users u
		ON u.idusers = a.users_idusers
    INNER JOIN article_has_rubrique h
		ON h.article_idarticle = a.idarticle
    INNER JOIN rubrique r
		ON h.rubrique_idrubrique = r.idrubrique
	WHERE a.thevisibility=1
		AND a.idarticle IN (SELECT art.idarticle FROM rubrique rub
					INNER JOIN article_has_rubrique has 
						ON has.rubrique_idrubrique = rub.idrubrique
					INNER JOIN article art 
						ON art.idarticle = has.article_idarticle
					WHERE has.rubrique_idrubrique=3
                    ORDER BY rub.theintitule ASC)
        AND h.rubrique_idrubrique IN 
			(SELECT ha.rubrique_idrubrique FROM article_has_rubrique ha WHERE ha.article_idarticle IN 
				(SELECT art.idarticle FROM rubrique rub
					INNER JOIN article_has_rubrique has 
						ON has.rubrique_idrubrique = rub.idrubrique
					INNER JOIN article art 
						ON art.idarticle = has.article_idarticle
					WHERE has.rubrique_idrubrique=3
                    ORDER BY rub.theintitule ASC
				)
            )
    GROUP BY a.idarticle
    ORDER BY a.thedate DESC
;


# les articles présents dans une rubrique par date descendante, avec l'auteur, lorsqu'ils sont visibles
SELECT a.idarticle, a.thetitle,LEFT(a.thetext,300) AS thetext, a.thedate,
	   u.thename,
       GROUP_CONCAT(r.idrubrique ORDER BY r.theintitule) AS idrubrique, 
       GROUP_CONCAT(r.theintitule ORDER BY r.theintitule SEPARATOR '|@|') AS theintitule
	FROM article a
    INNER JOIN users u
		ON u.idusers = a.users_idusers
    INNER JOIN article_has_rubrique h
		ON h.article_idarticle = a.idarticle
    INNER JOIN rubrique r
		ON h.rubrique_idrubrique = r.idrubrique
	WHERE a.thevisibility=1
		AND a.idarticle IN (SELECT art.idarticle FROM rubrique rub
					INNER JOIN article_has_rubrique has 
						ON has.rubrique_idrubrique = rub.idrubrique
					INNER JOIN article art 
						ON art.idarticle = has.article_idarticle
					WHERE has.rubrique_idrubrique=3
                    ORDER BY rub.theintitule ASC)
    GROUP BY a.idarticle
    ORDER BY a.thedate DESC
;

# pour se connecter

SELECT users.idusers, users.thename, users.themail,
	perm.thename AS permname, perm.theperm
	FROM users
    INNER JOIN perm
		ON perm.idperm = users.perm_idperm
    WHERE users.thelogin='Admin' AND users.thepwd='C1C224B03CD9BC7B6A86D77F5DACE40191766C485CD55DC48CAF9AC873335D6F';
    
# UPDATE updateOneArticleByUsers

UPDATE  article SET thetitle='TEST',thetext='du blabla',thedate='2019-05-16 09:40:08',thevisibility=0 WHERE idarticle=3 AND users_idusers = 2;

# DELETE m2m rubrique<->article
DELETE FROM article_has_rubrique WHERE article_idarticle=3;
  
