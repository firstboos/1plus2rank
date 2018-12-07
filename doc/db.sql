CREATE TABLE
    game_1plus2
    (
        seq INT NOT NULL AUTO_INCREMENT,
        name VARCHAR(100),
        score int,
        reg_time datetime,
        PRIMARY KEY (seq)
    )
    ENGINE=InnoDB DEFAULT CHARSET=utf8;
