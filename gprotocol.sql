/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100140
 Source Host           : localhost:3306
 Source Schema         : gprotocol

 Target Server Type    : MySQL
 Target Server Version : 100140
 File Encoding         : 65001

 Date: 20/11/2019 01:08:09
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for anexo
-- ----------------------------
DROP TABLE IF EXISTS `anexo`;
CREATE TABLE `anexo`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `protocolo_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `url` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `date` datetime(0) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for comentario
-- ----------------------------
DROP TABLE IF EXISTS `comentario`;
CREATE TABLE `comentario`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `protocolo_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `comentario` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `data` datetime(0) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for encaminhamento
-- ----------------------------
DROP TABLE IF EXISTS `encaminhamento`;
CREATE TABLE `encaminhamento`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `protocolo_id` int(11) DEFAULT NULL,
  `remetente_id` int(11) DEFAULT NULL,
  `dest_tipo` enum('SETOR','USUARIO') CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT 'SETOR',
  `destinatario_id` int(11) DEFAULT NULL,
  `tipo` enum('ENCAMINHAR','REJEITAR','ACEITAR','CRIAR') CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT 'CRIAR',
  `data` datetime(0) DEFAULT NULL,
  `justificativa` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of encaminhamento
-- ----------------------------
INSERT INTO `encaminhamento` VALUES (1, 5, 1, 'SETOR', 4, 'CRIAR', '2019-10-23 12:00:00', '');
INSERT INTO `encaminhamento` VALUES (2, 5, 1, 'SETOR', 1, 'ACEITAR', '2019-10-30 08:00:00', NULL);
INSERT INTO `encaminhamento` VALUES (3, 5, 1, 'SETOR', 1, 'REJEITAR', '2019-10-30 00:00:00', NULL);
INSERT INTO `encaminhamento` VALUES (14, 6, 1, 'SETOR', 1, 'REJEITAR', '2019-11-20 00:56:35', 'Houve uma falha no engano. Ops!');

-- ----------------------------
-- Table structure for protocolo
-- ----------------------------
DROP TABLE IF EXISTS `protocolo`;
CREATE TABLE `protocolo`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `dataCriacao` datetime(0) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `setor_id` int(11) NOT NULL,
  `descricao` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of protocolo
-- ----------------------------
INSERT INTO `protocolo` VALUES (5, 'Entrega de vacinas', '2019-10-23 15:20:00', 1, 1, 'Aviso de entrega das vacinas para o dia 25/10/2019.');
INSERT INTO `protocolo` VALUES (6, 'Entrega de documentos', '2019-11-06 18:30:00', 1, 1, 'Envio de documentos para a unidade Santa Luzia.');

-- ----------------------------
-- Table structure for setor
-- ----------------------------
DROP TABLE IF EXISTS `setor`;
CREATE TABLE `setor`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `unidade_id` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of setor
-- ----------------------------
INSERT INTO `setor` VALUES (1, 'Rouparia', 1);
INSERT INTO `setor` VALUES (2, 'Rouparia', 2);
INSERT INTO `setor` VALUES (3, 'Rouparia', 3);
INSERT INTO `setor` VALUES (4, 'Vacinacao', 1);
INSERT INTO `setor` VALUES (5, 'Vacinacao', 2);
INSERT INTO `setor` VALUES (6, 'Vacinacao', 3);
INSERT INTO `setor` VALUES (7, 'Alta Gerencia', 1);
INSERT INTO `setor` VALUES (8, 'Alta Gerencia', 2);
INSERT INTO `setor` VALUES (9, 'Alta Gerencia', 3);

-- ----------------------------
-- Table structure for unidade
-- ----------------------------
DROP TABLE IF EXISTS `unidade`;
CREATE TABLE `unidade`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of unidade
-- ----------------------------
INSERT INTO `unidade` VALUES (1, 'Unidade Concordia');
INSERT INTO `unidade` VALUES (2, 'Unidade Santa Luzia');
INSERT INTO `unidade` VALUES (3, 'Unidade BH');

-- ----------------------------
-- Table structure for usuario
-- ----------------------------
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `senha` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `telefone` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `cargo` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `setor_id` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of usuario
-- ----------------------------
INSERT INTO `usuario` VALUES (1, 'admin', '1234', 'admin@gprotocol.com', '(31) 9 9999-9999', 'Administrador', 1);

SET FOREIGN_KEY_CHECKS = 1;
