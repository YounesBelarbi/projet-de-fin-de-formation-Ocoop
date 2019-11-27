#!/usr/bin/env node

/* eslint-disable */

const path = require('path');

const copy = require('fs-extra').copy;
const globby = require('globby');
const argv = require('yargs').argv;
const log = require('loglevel');
const chalk = require('chalk');


const debug = argv.debug && 'debug';
log.setLevel(debug || 'info');
log.debug(process.argv, argv);



// Utils
function exitOnError(err) {
  if (err.message.includes('already exists')) {
    log.debug(chalk.yellow(err));
  } else {
    log.error(chalk.red(err));
    process.exit(1);
  }
}

function copyFiles(paths, destDir, baseDir) {
  return Promise.all(paths.map(path => {
    const filename = path.replace(baseDir, '');
    const destPath = destDir + filename;
    log.debug(path, '-->', destPath);
    copy(
      path,
      destPath,
      { overwrite: false, errorOnExist: true }
    ).catch(exitOnError);
  }));
}


// Context
const pathParsed = path.parse(__dirname);
const basePath = pathParsed.dir;           // model location
const targetPath = argv._[0] || '.'; // destination



// Let's go!
log.info(
  chalk.bgBlue('Copying model'),
  'from',
  chalk.underline(basePath),
  'to',
  chalk.underline(targetPath)
);

globby([
  basePath + '/*',
  basePath + '/.*',
  basePath + '/src',
  '!bin',
  '!node_modules'
]).then(function(files) {
  copyFiles(files, targetPath, basePath)
    .then(() => {
      log.info(chalk.green('Done!'))
    });
}).catch(exitOnError);
