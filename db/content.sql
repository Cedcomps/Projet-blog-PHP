insert into t_episode values
(1, 'Premier épisode', '<p>Ibique intersaepientes in Isauriae itinera viatorum adventicium inveniretur et opibus igitur pascebantur maritima ibique opibus et tempore Lycaoniam maritima pascebantur contulerunt Isauriae praetenturis in se itinera contulerunt opibus densis inveniretur ora opibus ora et Lycaoniam inveniretur intersaepientes se igitur nihil opibus Isauriae ibique densis ora cum in densis mox praetenturis contulerunt adnexam opibus Lycaoniam relicta adventicium cum et mox maritima ibique nihil adnexam contulerunt Lycaoniam itinera tempore densis Isauriae se ibique adventicium nihil maritima Lycaoniam igitur praetenturis ora igitur ibique tempore pascebantur intersaepientes cum in nihil se relicta adventicium adventicium intersaepientes nihil relicta Lycaoniam itinera ibique intersaepientes adnexam adventicium ora.</p>', 0, NOW());
insert into t_episode values
(2, 'Second épisode', '<p>Ibique intersaepientes in Isauriae itinera viatorum adventicium inveniretur et opibus igitur pascebantur maritima ibique opibus et tempore Lycaoniam maritima pascebantur contulerunt Isauriae praetenturis in se itinera contulerunt opibus densis inveniretur ora opibus ora et Lycaoniam inveniretur intersaepientes se igitur nihil opibus Isauriae ibique densis ora cum in densis mox praetenturis contulerunt adnexam opibus Lycaoniam relicta adventicium cum et mox maritima ibique nihil adnexam contulerunt Lycaoniam itinera tempore densis Isauriae se ibique adventicium nihil maritima Lycaoniam igitur praetenturis ora igitur ibique tempore pascebantur intersaepientes cum in nihil se relicta adventicium adventicium intersaepientes nihil relicta Lycaoniam itinera ibique intersaepientes adnexam adventicium ora.</p>', 0, NOW());
insert into t_episode values
(3, 'Troisième épisode', '<p>Ibique intersaepientes in Isauriae itinera viatorum adventicium inveniretur et opibus igitur pascebantur maritima ibique opibus et tempore Lycaoniam maritima pascebantur contulerunt Isauriae praetenturis in se itinera contulerunt opibus densis inveniretur ora opibus ora et Lycaoniam inveniretur intersaepientes se igitur nihil opibus Isauriae ibique densis ora cum in densis mox praetenturis contulerunt adnexam opibus Lycaoniam relicta adventicium cum et mox maritima ibique nihil adnexam contulerunt Lycaoniam itinera tempore densis Isauriae se ibique adventicium nihil maritima Lycaoniam igitur praetenturis ora igitur ibique tempore pascebantur intersaepientes cum in nihil se relicta adventicium adventicium intersaepientes nihil relicta Lycaoniam itinera ibique intersaepientes adnexam adventicium ora.</p>', 0, NOW());
insert into t_episode values
(4, 'Quatrième épisode', '<p>Ibique intersaepientes in Isauriae itinera viatorum adventicium inveniretur et opibus igitur pascebantur maritima ibique opibus et tempore Lycaoniam maritima pascebantur contulerunt Isauriae praetenturis in se itinera contulerunt opibus densis inveniretur ora opibus ora et Lycaoniam inveniretur intersaepientes se igitur nihil opibus Isauriae ibique densis ora cum in densis mox praetenturis contulerunt adnexam opibus Lycaoniam relicta adventicium cum et mox maritima ibique nihil adnexam contulerunt Lycaoniam itinera tempore densis Isauriae se ibique adventicium nihil maritima Lycaoniam igitur praetenturis ora igitur ibique tempore pascebantur intersaepientes cum in nihil se relicta adventicium adventicium intersaepientes nihil relicta Lycaoniam itinera ibique intersaepientes adnexam adventicium ora.</p>', 0, NOW());
insert into t_episode values
(5, 'Cinquième épisode', '<p>Ibique intersaepientes in Isauriae itinera viatorum adventicium inveniretur et opibus igitur pascebantur maritima ibique opibus et tempore Lycaoniam maritima pascebantur contulerunt Isauriae praetenturis in se itinera contulerunt opibus densis inveniretur ora opibus ora et Lycaoniam inveniretur intersaepientes se igitur nihil opibus Isauriae ibique densis ora cum in densis mox praetenturis contulerunt adnexam opibus Lycaoniam relicta adventicium cum et mox maritima ibique nihil adnexam contulerunt Lycaoniam itinera tempore densis Isauriae se ibique adventicium nihil maritima Lycaoniam igitur praetenturis ora igitur ibique tempore pascebantur intersaepientes cum in nihil se relicta adventicium adventicium intersaepientes nihil relicta Lycaoniam itinera ibique intersaepientes adnexam adventicium ora.</p>', 1, NOW());

/* raw password is 'john' */
insert into t_user values
(1, 'JohnDoe', 'testJohn@live.fr', '$2y$13$F9v8pl5u5WMrCorP9MLyJeyIsOLj.0/xqKd/hqa5440kyeB7FQ8te', 'YcM=A$nsYzkyeDVjEUa7W9K', 'ROLE_USER');
/* raw password is 'jane' */
insert into t_user values
(2, 'JaneDoe', 'testJane@live.fr', '$2y$13$qOvvtnceX.TjmiFn4c4vFe.hYlIVXHSPHfInEG21D99QZ6/LM70xa', 'dhMTBkzwDKxnD;4KNs,4ENy', 'ROLE_USER');
/* raw password is '@dm1n' */
insert into t_user values
(3, 'Jean Forteroche', 'admin@live.fr', '$2y$13$A8MQM2ZNOi99EW.ML7srhOJsCaybSbexAj/0yXrJs4gQ/2BqMMW2K', 'EDDsl&fBCJB|a5XUtAlnQN8', 'ROLE_ADMIN');

insert into t_comment values
(1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce ac.', 1, 1, NOW());
insert into t_comment values
(2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce ac.', 1, 2, NOW());
insert into t_comment values
(3, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce ac.', 2, 1, NOW());
insert into t_comment values
(4, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce ac.', 2, 2, NOW());
insert into t_comment values
(5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce ac.', 3, 1, NOW());
insert into t_comment values
(6, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce ac.', 3, 2, NOW());
