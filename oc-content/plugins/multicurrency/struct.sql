CREATE TABLE /*TABLE_PREFIX*/t_multicurrency (
    s_from VARCHAR(3) NOT NULL,
    s_to VARCHAR(3) NOT NULL,
    f_rate FLOAT NULL DEFAULT 1.0,
    dt_date DATETIME NOT NULL,

    PRIMARY KEY (s_from, s_to)
) ENGINE=InnoDB DEFAULT CHARACTER SET 'UTF8' COLLATE 'UTF8_GENERAL_CI';